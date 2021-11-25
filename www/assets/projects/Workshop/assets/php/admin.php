 <?php session_start();
 if(empty($_SESSION['mail'])){
	header("Location: ".$_server['server_name']."/assets/projects/Workshop/index.php");
}
?> 

<!DOCTYPE html>
<html xml:lang="en" lang="en">
    <head>
        <title>Administration</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
	    <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="container">
        <div class="row">
            <div class="search">
            <label>Search for user</label>
            <input type="search" data-search="data-search" placeholder="Search..."/>
            <button class="search__clear">&times;</button>
            <div class="recent-search">
                <button class="clear-btn" disabled="disabled" onclick="clearRecent()">No Recent Items</button>
                <div class="recent-search__list"></div>
            </div>
            </div>
            <div class="list" id="list" data-searchable="data-searchable"></div>
        </div>
        </div>
        <script src="../js/admin.js"></script>
    </body>
</html>