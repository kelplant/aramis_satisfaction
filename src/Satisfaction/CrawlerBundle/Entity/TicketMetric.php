<?php
/**
 * Created by PhpStorm.
 * User: guillaume
 * Date: 29/01/16
 * Time: 15:57
 */

namespace Satisfaction\CrawlerBundle\Entity;


class TicketMetric
{
    private $id;
    private $url;
    private $ticket_id;
    private $created_at;
    private $updated_at;
    private $group_stations;
    private $assignee_stations;
    private $reopens;
    private $replies;
    private $assignee_updated_at;
    private $requester_updated_at;
    private $status_updated_at;
    private $initially_assigned_at;
    private $assigned_at;
    private $solved_at;
    private $latest_comment_added_at;
    private $reply_time_in_minutes;
    private $first_resolution_time_in_minutes;
    private $full_resolution_time_in_minutes;
    private $agent_wait_time_in_minutes;
    private $requester_wait_time_in_minutes;
    private $on_hold_time_in_minutes;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Ticket
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     * @return TicketMetric
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTicketId()
    {
        return $this->ticket_id;
    }

    /**
     * @param mixed $ticket_id
     * @return Ticket
     */
    public function setTicketId($ticket_id)
    {
        $this->ticket_id = $ticket_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     * @return Ticket
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     * @return Ticket
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGroupStations()
    {
        return $this->group_stations;
    }

    /**
     * @param mixed $group_stations
     * @return Ticket
     */
    public function setGroupStations($group_stations)
    {
        $this->group_stations = $group_stations;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAssigneeStations()
    {
        return $this->assignee_stations;
    }

    /**
     * @param mixed $assignee_stations
     * @return Ticket
     */
    public function setAssigneeStations($assignee_stations)
    {
        $this->assignee_stations = $assignee_stations;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReopens()
    {
        return $this->reopens;
    }

    /**
     * @param mixed $reopens
     * @return Ticket
     */
    public function setReopens($reopens)
    {
        $this->reopens = $reopens;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReplies()
    {
        return $this->replies;
    }

    /**
     * @param mixed $replies
     * @return Ticket
     */
    public function setReplies($replies)
    {
        $this->replies = $replies;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAssigneeUpdatedAt()
    {
        return $this->assignee_updated_at;
    }

    /**
     * @param mixed $assignee_updated_at
     * @return Ticket
     */
    public function setAssigneeUpdatedAt($assignee_updated_at)
    {
        $this->assignee_updated_at = $assignee_updated_at;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequesterUpdatedAt()
    {
        return $this->requester_updated_at;
    }

    /**
     * @param mixed $requester_updated_at
     * @return Ticket
     */
    public function setRequesterUpdatedAt($requester_updated_at)
    {
        $this->requester_updated_at = $requester_updated_at;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusUpdatedAt()
    {
        return $this->status_updated_at;
    }

    /**
     * @param mixed $status_updated_at
     * @return Ticket
     */
    public function setStatusUpdatedAt($status_updated_at)
    {
        $this->status_updated_at = $status_updated_at;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInitiallyAssignedAt()
    {
        return $this->initially_assigned_at;
    }

    /**
     * @param mixed $initially_assigned_at
     * @return Ticket
     */
    public function setInitiallyAssignedAt($initially_assigned_at)
    {
        $this->initially_assigned_at = $initially_assigned_at;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAssignedAt()
    {
        return $this->assigned_at;
    }

    /**
     * @param mixed $assigned_at
     * @return Ticket
     */
    public function setAssignedAt($assigned_at)
    {
        $this->assigned_at = $assigned_at;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSolvedAt()
    {
        return $this->solved_at;
    }

    /**
     * @param mixed $solved_at
     * @return Ticket
     */
    public function setSolvedAt($solved_at)
    {
        $this->solved_at = $solved_at;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLatestCommentAddedAt()
    {
        return $this->latest_comment_added_at;
    }

    /**
     * @param mixed $latest_comment_added_at
     * @return Ticket
     */
    public function setLatestCommentAddedAt($latest_comment_added_at)
    {
        $this->latest_comment_added_at = $latest_comment_added_at;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReplyTimeInMinutes()
    {
        return $this->reply_time_in_minutes;
    }

    /**
     * @param mixed $reply_time_in_minutes
     * @return Ticket
     */
    public function setReplyTimeInMinutes($reply_time_in_minutes)
    {
        $this->reply_time_in_minutes = $reply_time_in_minutes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstResolutionTimeInMinutes()
    {
        return $this->first_resolution_time_in_minutes;
    }

    /**
     * @param mixed $first_resolution_time_in_minutes
     * @return Ticket
     */
    public function setFirstResolutionTimeInMinutes($first_resolution_time_in_minutes)
    {
        $this->first_resolution_time_in_minutes = $first_resolution_time_in_minutes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFullResolutionTimeInMinutes()
    {
        return $this->full_resolution_time_in_minutes;
    }

    /**
     * @param mixed $full_resolution_time_in_minutes
     * @return Ticket
     */
    public function setFullResolutionTimeInMinutes($full_resolution_time_in_minutes)
    {
        $this->full_resolution_time_in_minutes = $full_resolution_time_in_minutes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAgentWaitTimeInMinutes()
    {
        return $this->agent_wait_time_in_minutes;
    }

    /**
     * @param mixed $agent_wait_time_in_minutes
     * @return Ticket
     */
    public function setAgentWaitTimeInMinutes($agent_wait_time_in_minutes)
    {
        $this->agent_wait_time_in_minutes = $agent_wait_time_in_minutes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequesterWaitTimeInMinutes()
    {
        return $this->requester_wait_time_in_minutes;
    }

    /**
     * @param mixed $requester_wait_time_in_minutes
     * @return Ticket
     */
    public function setRequesterWaitTimeInMinutes($requester_wait_time_in_minutes)
    {
        $this->requester_wait_time_in_minutes = $requester_wait_time_in_minutes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOnHoldTimeInMinutes()
    {
        return $this->on_hold_time_in_minutes;
    }

    /**
     * @param mixed $on_hold_time_in_minutes
     * @return Ticket
     */
    public function setOnHoldTimeInMinutes($on_hold_time_in_minutes)
    {
        $this->on_hold_time_in_minutes = $on_hold_time_in_minutes;
        return $this;
    }

}
