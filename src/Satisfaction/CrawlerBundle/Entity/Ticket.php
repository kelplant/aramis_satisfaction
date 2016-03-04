<?php
/**
 * Created by PhpStorm.
 * User: guillaume
 * Date: 29/01/16
 * Time: 15:57
 */

namespace Satisfaction\CrawlerBundle\Entity;


class Ticket
{
    private $id;
    private $url;
    private $external_id;
    private $type;
    private $subject;
    private $raw_subject;
    private $description;
    private $priority;
    private $status;
    private $recipient;
    private $requester_id;
    private $submitter_id;
    private $assignee_id;
    private $organization_id;
    private $group_id;
    private $collaborator_ids;
    private $forum_topic_id;
    private $problem_id;
    private $has_incidents;
    private $due_at;
    private $tags;
    private $via;
    private $custom_fields;
    private $fields;
    private $satisfaction_rating;
    private $sharing_agreement_ids;
    private $followup_ids;
    private $ticket_form_id;
    private $brand_id;
    private $created_at;
    private $updated_at;

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
     * @return Ticket
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExternalId()
    {
        return $this->external_id;
    }

    /**
     * @param mixed $external_id
     * @return Ticket
     */
    public function setExternalId($external_id)
    {
        $this->external_id = $external_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Ticket
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     * @return Ticket
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRawSubject()
    {
        return $this->raw_subject;
    }

    /**
     * @param mixed $raw_subject
     * @return Ticket
     */
    public function setRawSubject($raw_subject)
    {
        $this->raw_subject = $raw_subject;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Ticket
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param mixed $priority
     * @return Ticket
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return Ticket
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param mixed $recipient
     * @return Ticket
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequesterId()
    {
        return $this->requester_id;
    }

    /**
     * @param mixed $requester_id
     * @return Ticket
     */
    public function setRequesterId($requester_id)
    {
        $this->requester_id = $requester_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubmitterId()
    {
        return $this->submitter_id;
    }

    /**
     * @param mixed $submitter_id
     * @return Ticket
     */
    public function setSubmitterId($submitter_id)
    {
        $this->submitter_id = $submitter_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAssigneeId()
    {
        return $this->assignee_id;
    }

    /**
     * @param mixed $assignee_id
     * @return Ticket
     */
    public function setAssigneeId($assignee_id)
    {
        $this->assignee_id = $assignee_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrganizationId()
    {
        return $this->organization_id;
    }

    /**
     * @param mixed $organization_id
     * @return Ticket
     */
    public function setOrganizationId($organization_id)
    {
        $this->organization_id = $organization_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGroupId()
    {
        return $this->group_id;
    }

    /**
     * @param mixed $group_id
     * @return Ticket
     */
    public function setGroupId($group_id)
    {
        $this->group_id = $group_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCollaboratorIds()
    {
        return $this->collaborator_ids;
    }

    /**
     * @param mixed $collaborator_ids
     * @return Ticket
     */
    public function setCollaboratorIds($collaborator_ids)
    {
        $this->collaborator_ids = $collaborator_ids;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getForumTopicId()
    {
        return $this->forum_topic_id;
    }

    /**
     * @param mixed $forum_topic_id
     * @return Ticket
     */
    public function setForumTopicId($forum_topic_id)
    {
        $this->forum_topic_id = $forum_topic_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProblemId()
    {
        return $this->problem_id;
    }

    /**
     * @param mixed $problem_id
     * @return Ticket
     */
    public function setProblemId($problem_id)
    {
        $this->problem_id = $problem_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHasIncidents()
    {
        return $this->has_incidents;
    }

    /**
     * @param mixed $has_incidents
     * @return Ticket
     */
    public function setHasIncidents($has_incidents)
    {
        $this->has_incidents = $has_incidents;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDueAt()
    {
        return $this->due_at;
    }

    /**
     * @param mixed $due_at
     * @return Ticket
     */
    public function setDueAt($due_at)
    {
        $this->due_at = $due_at;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     * @return Ticket
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVia()
    {
        return $this->via;
    }

    /**
     * @param mixed $via
     * @return Ticket
     */
    public function setVia($via)
    {
        $this->via = $via;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param mixed $fields
     * @return Ticket
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomFields()
    {
        return $this->custom_fields;
    }

    /**
     * @param mixed $custom_fields
     * @return Ticket
     */
    public function setCustomFields($custom_fields)
    {
        $this->custom_fields = $custom_fields;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSatisfactionRating()
    {
        return $this->satisfaction_rating;
    }

    /**
     * @param mixed $satisfaction_rating
     * @return Ticket
     */
    public function setSatisfactionRating($satisfaction_rating)
    {
        $this->satisfaction_rating = $satisfaction_rating;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSharingAgreementIds()
    {
        return $this->sharing_agreement_ids;
    }

    /**
     * @param mixed $sharing_agreement_ids
     * @return Ticket
     */
    public function setSharingAgreementIds($sharing_agreement_ids)
    {
        $this->sharing_agreement_ids = $sharing_agreement_ids;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFollowupIds()
    {
        return $this->followup_ids;
    }

    /**
     * @param mixed $followup_ids
     * @return Ticket
     */
    public function setFollowupIds($followup_ids)
    {
        $this->followup_ids = $followup_ids;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTicketFormId()
    {
        return $this->ticket_form_id;
    }

    /**
     * @param mixed $ticket_form_id
     * @return Ticket
     */
    public function setTicketFormId($ticket_form_id)
    {
        $this->ticket_form_id = $ticket_form_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * @param mixed $brand_id
     * @return Ticket
     */
    public function setBrandId($brand_id)
    {
        $this->brand_id = $brand_id;
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
}
