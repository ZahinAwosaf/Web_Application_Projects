<?php

session_start();
$syn = '';

include('db_connection.php');


$sql = 'select * from faq_questions order by timestamp desc';
$result = $conn->query($sql);

$i = 1;
$flag = true;
while($row = $result->fetch_assoc()) {
	$syn .= '<div id="no-of-questions" class="question-faq"><h4>'.$row['question_text'].'</h4>';
	
	$sql2 = 'select * from question_answers where faq_que_id = '.$row['faq_que_id'].' order by timestamp desc';
	$result2 = $conn->query($sql2);
	if(mysqli_num_rows($result2) > 0) {
		$row2 = $result2->fetch_assoc();
		$syn .= '<div id="question-first-sec"><h5>Answer 1</h5><p>'.$row2['que_answer'].'</p></div><div id="question-hide-sec-'.$row['faq_que_id'].'" class="question-ans-hide">';

		$j = 2;
		while($row2 = $result2->fetch_assoc()) {
			$syn .= '<h5>Answer '.$j.'</h5><p>'.$row2['que_answer'].'</p>'; 
			$j++;
		}
		$syn .= '</div>';
	}
	$syn .= '<div id="button-on-faq-sec"><button class="'.$row['faq_que_id'].'" id="faq-reply-btn" name="'.$row['question_text'].'">Reply</button><button id="faq-showmore-btn" class="'.$row['faq_que_id'].'">Show more</button></div></div>';
	$i++;
}

echo $syn;

$conn->close();



?>