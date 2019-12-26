<?php
/**
 * 用户的课程记录
 * @文件名称: UserCourseController
 * @author: jawei
 * @Email: gaozhiwei@etcp.cn
 * @Date: 2017-06-06
 * @Copyright: 2017 悦畅科技有限公司. All rights reserved.
 * 注意：本内容仅限于悦畅科技有限公司内部传阅，禁止外泄以及用于其他的商业目的
 */
namespace commands;
use appcomponents\modules\common\CourseService;
use appcomponents\modules\common\UserCourseService;
use appcomponents\modules\common\UserStudyService;
use appcomponents\modules\passport\PassportService;
use source\libs\DmpUtil;
use source\manager\BaseService;
use yii\console\Controller;

class UserCourseController extends Controller{
    //0 * * * * /usr/bin/php /data/www/dangjian-manage/yii user-course/add>> /data/logs/crontab/$(date +\%Y\%m\%d)-dangjian-manage-user-course-add.log
    /**
     * 每小时执行一次
     * @return array
     */
	public function actionAdd() {
        $dmpUtil = new DmpUtil();
        $ret = "";
        $startTime = time();
        $courseService = new CourseService();
        $params = [];
        $params[] = ['=', 'status', 1];
        $params[] = ['=', 'elective_type', 2];
        $size = 100;

        $passportService = new PassportService();
        $userParams[] = ['=', 'status', 1];
        $userListRet = $passportService->getUserList($userParams, [], 1, $size, ['id']);

        $courseListRet = $courseService->getList($params, [], 1, -1, ['id','lessions_count']);
        $courseDataList = BaseService::getRetData($courseListRet);

        $userCourse = [];
        $userCourseService = new UserCourseService();
        $userStudyService = new UserStudyService();
        if(BaseService::checkRetIsOk($userListRet)) {
            $userDataList = BaseService::getRetData($userListRet);
            $userCount = isset($userDataList['count']) ? $userDataList['count'] : 0;
            $userTotalPage = intval(ceil($userCount/$size));
            for($i=1; $i<=$userTotalPage;$i++) {
                if($i>1) {
                    $userListRet = $passportService->getUserList($userParams, [], $i, $size, ['id']);
                    $userDataList = BaseService::getRetData($userListRet);
                }
                if(isset($userDataList['dataList'])) {
                foreach ($userDataList['dataList'] as $userData) {
                    if(isset($courseDataList['dataList'])) {
                        foreach ($courseDataList['dataList'] as $courseData) {
                            $course_id = isset($courseData['id']) ? $courseData['id'] : 0;
                            $user_id = isset($userData['id']) ? $userData['id'] : 0;
                            $userCourseParams = [];
                            $userCourseParams[] = ['=', 'course_id', $course_id];
                            $userCourseParams[] = ['=', 'user_id', $user_id];
                            $userCourseParams[] = ['!=', 'status', 1];
                            $userCourseInfoRet = $userCourseService->getInfo($userCourseParams);
                            if(!BaseService::checkRetIsOk($userCourseInfoRet)) {
                                $userCourse[] = [
                                    'course_id' =>$course_id,
                                    'user_id' =>$user_id,
                                    'lessions_count' =>isset($courseData['lessions_count']) ? $courseData['lessions_count'] : 0,
                                    'elective_type' =>isset($courseData['elective_type']) ? $courseData['elective_type'] : 1,
                                ];
                            } else {
                                $userCourseInfo = BaseService::getRetData($userCourseInfoRet);
                                $userStudyParams = [];
                                $userStudyParams[] = ['=', 'user_id', $user_id];
                                $userStudyParams[] = ['=', 'course_id', $course_id];
                                $userStudyParams[] = ['=', 'status', 1];
                                $userStudyRet = $userStudyService->getList($userStudyParams, [], 1, -1, ['user_id','course_id','status']);
                                $userStudyData = BaseService::getRetData($userStudyRet);
                                if(isset($userStudyData['count'])) {
                                    $editUserCourseData = [
                                        'id' => isset($userCourseInfo['id']) ? $userCourseInfo['id'] : 0,
                                        'study_lessions_count' => $userStudyData['count'],
                                    ];
                                    if($userStudyData['count']==$courseData['lessions_count']) {
                                        $editUserCourseData['status'] = 1;
                                    }
                                    $userCourseService->editInfo($editUserCourseData);
                                }
                            }
                        }
                    }
//                    $j++;
                }
                }
//                $i++;
            }
            $ret = $userCourseService->addAll($userCourse);
        }
        $endTime = time();
        $dmpUtil->dump($ret);
        $dmpUtil->dump('executtime:'.($endTime-$startTime)."s"."   startTime:".date('Y-m-d H:i:s', $startTime)."   endTime:".date('Y-m-d H:i:s', $endTime));
    }
    //0 * * * * /usr/bin/php /data/www/dangjian-manage/yii user-course/save-study-num>> /data/logs/crontab/$(date +\%Y\%m\%d)-dangjian-manage-user-course-save-study-num.log
    /**
     * 每小时执行一次,将课程的学习用户数更新到课程数据中
     * @return array
     */
    public function actionSaveStudyNum() {
        $dmpUtil = new DmpUtil();
        $ret = "";
        $startTime = time();
        $params = [];
        $params[] = ['=', 'status', 1];
        $courseService = new CourseService();
        $courseListRet = $courseService->getList($params, [], 1, -1, ['id','lessions_count']);
        $courseDataList = BaseService::getRetData($courseListRet);
        $userCourseService = new UserCourseService();
        if(isset($courseDataList['dataList'])) {
            foreach ($courseDataList['dataList'] as $courseData) {
                $course_id = isset($courseData['id']) ? $courseData['id'] : 0;
                $userStudyParams[] = ['=', 'course_id', $course_id];
                $userStudyParams[] = ['!=', 'study_lessions_count', 0];
                $userStudyRet = $userCourseService->getList($userStudyParams, [], 1, -1, ['id']);
                $userStudyData = BaseService::getRetData($userStudyRet);
                $count = isset($userStudyData['count']) ? $userStudyData['count'] : 0;
                $courseData = [
                    'id'=>$course_id,
                    'study_count'=>$count,
                ];
                $ret = $courseService->editInfo($courseData);
            }
        }
        $endTime = time();
        $dmpUtil->dump($ret);
        $dmpUtil->dump('executtime:'.($endTime-$startTime)."s"."   startTime:".date('Y-m-d H:i:s', $startTime)."   endTime:".date('Y-m-d H:i:s', $endTime));
    }
}
