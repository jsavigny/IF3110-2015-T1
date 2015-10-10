<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Simple Stack Exchange</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!--<script type="text/javascript" src="javascript/javascript.js"></script>-->
	<?php require_once('dbconnect.php'); ?>
</head>

<body>
	<div id="wrapper">
    
        <div id="header">
        
            <div id="title">
                <p class="center">Simple StackExchange</p>
            </div>
            
            <div class="center">
            	<form id="form" name="search" action="" method="GET">
                    <input autofocus type="text" name="search" id="search-bar" placeholder="Search question topic or content here..." >
                    <input id ="search-submit" type="submit" value="Search">
				</form>
            </div>
            
        </div>
        <div id="nav">
        	<div id="askme">
            	<p class="center">Cannot find what you are looking for? <a href="askme.html" class="orange">Ask Here</a></p>
            </div>
        </div>
        <div id="contents">
        	<h2><p>Recently Asked Questions</p></h2>
            <hr>
            <div id="questions">
            	<div class="questionbox">
                	<?php
					
						
						//$sql = "SELECT name,email,qtopic,content,vote FROM question ORDER BY id DESC";
						$sql = "SELECT
									question.name as name,
									question.email as email,
									question.qtopic as qtopic,
									question.content as content,
									question.vote as vote,
									count(answers.qid) as number_of_answer
								from question
								left join answers
								on (question.id = answers.qid)
								group by
									question.name,
									question.email,
									question.qtopic,
									question.content,
									question.vote";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							$result_list = array();
							while($row = $result->fetch_assoc()) {
								$result_list[] = $row;
							}
							foreach($result_list as $row) {?>
								<div class="questionbox">
                                    <div class="voteanswer">
                                        <div class="qvote">
                                            <div class="counter">
                                                <?=$row["vote"]?>
                                            </div>
                                            <div class="word">
                                                Vote
                                            </div>
                                        </div>
                                        <div class="avote">
                                            <div class="counter">
                                                <?=$row["number_of_answer"]?>
                                            </div>
                                            <div class="word">
                                                Answer
                                            </div>
                                        </div>
                                    </div>
                                    <div class="qboxtopic">
                                         <?=$row["qtopic"]?>
                                    </div>                
                                    <div class="qmeta">
                                        Asked by  <?=$row["email"]?> | <a href="">edit</a> | <a href="">delete</a> 
                                    </div>
                                <hr>
							</div>
							<?php
							}
						}					
						$conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>