document.getElementById('issueInputForm').addEventListener('submit', saveIssue);
function saveIssue(e){
    var issueDesc = document.getElementById('issueDesInput').value;
    var issueSeverity = document.getElementById('issueSevrtityInput').value;
    var issueSAssignTo = document.getElementById('issueAssignInput').value;
    var issueId = chance.guid();
    var issueStatus = "Open";

    var issue = {
        id: issueId,
        desc: issueDesc,
        severity: issueSeverity,
        status: issueStatus,
        assignTo: issueSAssignTo
    }

    if(localStorage.getItem('issues') == null){
        var issues = [];
        issues.push(issue);
        localStorage.setItem('issues', JSON.stringify(issues));
    } else {
        var issues = JSON.parse(localStorage.getItem('issues'));
        issues.push(issue);
        localStorage.setItem('issues', JSON.stringify(issues));
    }

    document.getElementById('issueInputForm').reset();

    fetchIssues();

    e.preventDefault();

}

function setStatusClosed(id){
    var issues = JSON.parse(localStorage.getItem('issues'));
    for(var i = 0; i < issues.length; i ++) {
        if(issues[i].id == id) {
            issues[i].status = "Closed";
        }
    }

    localStorage.setItem('issues', JSON.stringify(issues));
    fetchIssues();
}

function deleteIssue(id){
    var issues = JSON.parse(localStorage.getItem('issues'));
    for(var i = 0; i < issues.length; i ++) {
        if(issues[i].id == id) {
            issues.splice(i, 1);
        }
    }

    localStorage.setItem('issues', JSON.stringify(issues));
    fetchIssues();
}


function fetchIssues(){
    var issues = JSON.parse(localStorage.getItem('issues'));
    var issuesList = document.getElementById('issuesList');
    //console.log(issues);

    issuesList.innerHTML = '';

    for(var i = 0; i < issues.length; i++){
        var id = issues[i].id;
        // console.log(id)
        var desc = issues[i].desc;
        var severity = issues[i].severity;
        var assignTo = issues[i].assignTo;
        var status = issues[i].status;

        issuesList.innerHTML += '<div class="card card-body bg-light mb-2">' +
                                '<h6>Issue ID: ' + id + '</h6>' +
                                '<p><span class="badge badge-primary">' + status + '</span></p>' +
                                '<h3>' + desc + '</h3>' +
                                '<p><span class="fa fa-clock-o"></span> ' + severity + '</p>' +
                                '<p><span class="fa fa-user"></span> ' + assignTo + '</p>' +
                                '<div class="btn-group-sm"><a href="#" onclick="setStatusClosed(\''+id+'\')" class="btn btn-warning mr-2">Close</a>' +  
                                '<a href="#" onclick="deleteIssue(\''+id+'\')" class="btn btn-danger">Delete</a></div>' +  
                                '</div>';
    }
}