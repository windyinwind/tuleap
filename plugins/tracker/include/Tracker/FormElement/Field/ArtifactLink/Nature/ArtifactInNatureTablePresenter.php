<?php
/**
 * Copyright (c) Sogilis, 2016. All Rights Reserved.
 *
 * This file is a part of Tuleap.
 *
 * Tuleap is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Tuleap is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Tuleap. If not, see <http://www.gnu.org/licenses/>.
*/

namespace Tuleap\Tracker\FormElement\Field\ArtifactLink\Nature;

class ArtifactInNatureTablePresenter {

    public $direct_link_to_artifact;
    public $project_public_name;
    public $tracker_name;
    public $artifact_title;
    public $artifact_status;
    public $artifact_last_update_date;
    public $artifact_submitter;
    public $artifact_assignees;
    public $html_classes;

    public function __construct(\Tracker_Artifact $artifact, $html_classes) {
        $this->html_classes = $html_classes;
        $tracker            = $artifact->getTracker();
        $project            = $tracker->getProject();
        $user_helper        = \UserHelper::instance();
        $current_user       = \UserManager::instance()->getCurrentUser();

        $this->direct_link_to_artifact   = $artifact->fetchDirectLinkToArtifact();
        $this->project_public_name       = $project->getPublicName();
        $this->tracker_name              = $this->emptyStringIfNull($tracker->getName());
        $this->artifact_title            = $this->emptyStringIfNull($artifact->getTitle());
        $this->artifact_status           = $this->emptyStringIfNull($artifact->getStatus());
        $this->artifact_last_update_date = date('Y-d-m H:i', $artifact->getLastUpdateDate());

        $assignees      = $artifact->getAssignedTo($current_user);
        $assignee_links = array();
        foreach($assignees as $assignee) {
            $assignee_links[] = $user_helper->getLinkOnUser($assignee);
        }
        $this->artifact_assignees = implode(', ', $assignee_links);

        if($this->userCanReadSubmitter($tracker, $current_user)) {
            $this->artifact_submitter = $user_helper->getLinkOnUser($artifact->getSubmittedByUser());
        } else {
            $this->artifact_submitter = '';
        }
    }

    private function userCanReadSubmitter(\Tracker $tracker, \PFUser $current_user) {
        $formelement_factory = \Tracker_FormElementFactory::instance();
        $fields              = $formelement_factory->getUsedSubmittedByFields($tracker);
        foreach($fields as $field) {
            if($field->userCanRead($current_user)) {
                return true;
            }
        }
        return false;
    }

    private function emptyStringIfNull($value) {
        if($value === null) {
            return '';
        }
        return $value;
    }
}
