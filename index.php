<?php
// Start the session
session_start();
?>
<?php
 echo '<link rel="stylesheet" type="text/css" href="/sass/stylesheets/homepage.css">';
 print_r($_GET);

 switch ($_GET['action']) {
 	//This case will perform signin	
 	case 'signin':
 		require 'signin.php';
		$status = loginCheck();
 		if ($status == true) {
 			loginFound();
 		}
 		else {
 			loginFound();
 		}
 		getLogin();
 		break;

 	//This case will perform signup 	
 	case 'signup':
	 	require 'signup_page.php';
	 	createAccount();
	 	signupDisplay();
	 	break;

	//This case will display the options as per the user's role
	case 'user':
		require 'main_page.php';
 		checkSession();
 		break;

 	//This case will perform signout	
 	case 'signout':
 		require 'signout.php';
 		break;

 	//This case will display the list of workspaces created by Admin	
 	case 'getWorkspaces':
 		echo "mohit"; 
 		require 'list_workspaces.php';
 		getWorkspaces();
 		break;

 	//This case is for creating a workspace
 	case 'createWorkspace':
 		require 'create_workspace.php';
 		createWorkspace();
 		getContent();	
 		break;			 	

 	//This will display list of workspaces which belongs to a manager
 	case 'managerWorkspaces':
 		require 'manager_workspace.php';
 		getmanagerWorkspaces();
 		break;

 	case 'managerWorkspace':
 		require 'manager_workspace.php';
 		getmanagerWorkspaces();
 		break;

 	//This will display list of tasks
 	case 'listTasks':
 		require 'list_of_tasks.php';
 		break;

 	//This is for creating a task by the manager
 	case 'taskCreate':
 		require 'task_create.php';
 		break;

 	//This case is for see the time log entries on the basis of date selected
 	case 'filter':
 		require 'filter.php';
 		break;

 	//This case is for displaying the entries which developer has done
 	case 'timelog':
 		require 'time_log.php';
 		break;

 	case 'workspaceTask':
 		require 'workspace_task.php';
 		break;

 	//This case is for add or remove managers and developers for particular workspaces
 	case 'addrem':
 		require 'addrem.php';
 		break;					
 	
 	//This is the default case i.e index.php	
 	default:
 		require 'home.php';
 		getHome();
 		break;
 }
?>	