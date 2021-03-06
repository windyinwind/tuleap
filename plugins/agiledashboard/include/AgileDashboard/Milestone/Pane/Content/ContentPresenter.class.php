<?php
/**
 * Copyright Enalean (c) 2013 - 2018. All rights reserved.
 *
 * Tuleap and Enalean names and logos are registrated trademarks owned by
 * Enalean SAS. All other trademarks or names are properties of their respective
 * owners.
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

use Tuleap\AgileDashboard\Milestone\Pane\Conent\ContentChartPresenter;

class AgileDashboard_Milestone_Pane_Content_ContentPresenter
{
    public $no_items_label;

    /** @var AgileDashboard_Milestone_Backlog_BacklogItemPresenterCollection */
    public $items_collection;

    /** @var AgileDashboard_Milestone_Backlog_BacklogItemPresenterCollection */
    private $inconsistent_collection;

    /** @var String */
    public $backlog_item_type;

    /** @var String */
    private $solve_inconsistencies_url;
    /**
     * @var ContentChartPresenter
     */
    public $chart_presenter;

    public function __construct(
        Planning_Milestone $milestone,
        AgileDashboard_Milestone_Backlog_BacklogItemPresenterCollection $items,
        AgileDashboard_Milestone_Backlog_BacklogItemPresenterCollection $inconsistent_collection,
        $trackers,
        $solve_inconsistencies_url,
        PFUser $user,
        ContentChartPresenter $chart_presenter
    ) {
        $this->items_collection          = $items;
        $this->inconsistent_collection   = $inconsistent_collection;
        $this->backlog_item_type         = $this->getTrackerNames($trackers);
        $this->solve_inconsistencies_url   = $solve_inconsistencies_url;

        $this->no_items_label  = dgettext('plugin-agiledashboard', 'There is no item yet');
        $this->chart_presenter = $chart_presenter;
    }

    private function getTrackerNames($trackers)
    {
        $tracker_names = array();

        foreach ($trackers as $tracker) {
            $tracker_names[] = $tracker->getName();
        }

        return implode(', ', $tracker_names);
    }

    public function getTemplateName() {
        return 'pane-content';
    }

    public function solve_inconsistencies_button() {
        return $GLOBALS['Language']->getText('plugin_agiledashboard_contentpane', 'solve_inconsistencies');
    }

    public function solve_inconsistencies_url() {
        return $this->solve_inconsistencies_url;
    }

    public function item_title()
    {
        return $GLOBALS['Language']->getText('plugin_agiledashboard', 'content_head_title');
    }

    public function status_title()
    {
        return dgettext('plugin-agiledashboard', 'Status');
    }

    public function parent_title()
    {
        return $GLOBALS['Language']->getText('plugin_agiledashboard', 'content_head_parent');
    }

    public function has_something()
    {
        return $this->items_collection->count() > 0;
    }

    public function inconsistent_items_title() {
        return $GLOBALS['Language']->getText('plugin_agiledashboard_contentpane', 'inconsistent_items_title', $this->backlog_item_type);
    }

    public function inconsistent_items_intro() {
        return $GLOBALS['Language']->getText('plugin_agiledashboard_contentpane', 'inconsistent_items_intro');
    }

    public function has_something_inconsistent() {
        return count($this->inconsistent_collection) > 0;
    }

    public function inconsistent_collection() {
        return $this->inconsistent_collection;
    }
}
