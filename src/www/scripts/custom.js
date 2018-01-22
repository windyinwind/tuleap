
jQuery(document).ready(function() {
    let repoNameInputCtrl = `<div class="control-group">
                        <label class="control-label">Repository Name</label>
                        <div class="controls">
                            <input size="40" type="text" id="repo_name" name="repo_name" value="" autofocus="">
                        </div>
                    </div>`;
    // Attach event to scrum template check box
    jQuery("input[type='radio'][name='built_from_template'][value='101']").unbind("click").click(function(){
        jQuery(this).closest(".one_step_project_choose_template").append(repoNameInputCtrl);
        // Add input event to Repo contrl once it added to page
        jQuery("#repo_name").change(function(){
            // store it's value in session storage
            let repo_name = jQuery(this).val();
            if(repo_name) {
                sessionStorage.setItem("repo_name", JSON.stringify(repo_name));
            }
        });
    });

    // Get repo_name stored in sessionStorage
    let repoName = JSON.parse(sessionStorage.getItem("repo_name"));
    if (repoName) {
        //  Get git link Element
        let gitLinkEle = jQuery("#sidebar-plugin_git");
        // Store git link url
        let gitLinkUrl = gitLinkEle.attr("href");
        // Set git link href to avoid page fresh before custom repo creation finished
        gitLinkEle.attr("href") = "#";
        // Attach event to git link
        gitLinkEle.unbind("click").click(function(){
            if(repoName) {
                jQuery.post("plugins/git/?group_id=101", {
                    action:"add",
                    repo_name: repoName,
                    repo_add: "Create"
                }, function(data) {
                    console.log("Create repo success");
                    // Remove repot name in session storage
                    sessionStorage.removeItem("repo_name");
                    // Resume git link default behavior
                    location.href = gitLinkUrl;
                }).fail(function(){
                    console.log("Create repo fail");
                });

            }
        });
    }


});
