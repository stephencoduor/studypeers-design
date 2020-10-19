<?php

namespace Studypeers\CanvasApi\Clients;

/**
 * https://canvas.instructure.com/doc/api/reports.html
 */
class Discussions implements CanvasApiClientInterface
{
    public function listCourseDiscussionTopics($course_id)
    {
        return [
			
			'courses/'.$course_id.'/discussion_topics',
            'get'
        ];
	}
	public function listGroupDiscussionTopics($group_id)
    {
        return [
			
			'groups/'.$group_id.'/discussion_topics',
            'get'
        ];
    }

   
}
