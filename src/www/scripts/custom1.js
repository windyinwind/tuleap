jQuery(document).ready(function(){
    // Get repo_name stored in sessionStorage
    let repoName = JSON.parse(sessionStorage.getItem("repo_name"));
    if (repoName) {
        //  Get git link Element
        let gitLinkEle = jQuery("#sidebar-plugin_git");
        // Store git link url
        let gitLinkUrl = gitLinkEle.attr("href");
        // Set git link href to avoid page fresh before custom repo creation finished
        gitLinkEle.attr("href", "#");
        // Attach event to git link
        gitLinkEle.unbind("click").click(function(){
            if(repoName) {
                jQuery.post("/plugins/git/?group_id=101", {
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
