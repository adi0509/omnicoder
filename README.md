# Omnicoder
This is a web-app built with PHP, and was used in Computer Science Department fest ([Turington](https://turington.in/)) of [Ramanujan College](http://www.rcdu.in/).<br>
In this event we have 2 rounds:<br>

| Round | No of questions	| Marks for each correct answer	| Negative marking								| Instructions								|
|-------|-----------------|-------------------------------|---------------------------------|-----------------------------|
| 1.		| 20							| 4 														| Yes (-1 for each wrong answer)	| <b>1.</b> Register using the link provided and begin the test<br> <b>2.</b> You'll reach a ranking page at the end where selected students will get login credentials for the next round.<br><br> The answer checking for this round is automatic and ranking will be based on marks and submission time |
| 2.		| 10							| 5															| none														| <b>1. User can use any one language of his/her choice to answer questions in this round</b><br><b>2.</b> Login using the credentials provided to you earlier and start answering the questions.<br><br>There will be a manual checking for the answers in this round. The participant wo gets maximum correct answers in minimum time will be declared the winner. |

<h3>How to run omnicoder web-app after cloning</h3>

<span><b>Step 1: </b>Import <b>omnicoder.sql</b> to your xampp</span><br>
<span><b>Step 2: </b>Go to <b>./omnicoder/</b></span><br>
<span><b>Step 3: </b>Register and attempt round 1</span><br>
<span><b>Step 4: </b>After all participant had submitted their result, then we'll calculate result by running <b>./omnicoder2/calculateResult.php</b></span><br>
<span><b>Step 5: </b>go to <b>./omnicoder/result/index.php</b> and change <b>$noSelected</b>, number of students you want to select.</span><br>
<span><b>Step 6: </b>Now database will be updated with marks, now to get ranking go to <b>./omnicoder/result</b></span><br>
<span><b>Step 7: </b>Now those people who got selected will get a random login id and password.</span><br>
<span><b>Step 8: </b>Now go to <b>/omnicoder2/</b> and attempt round 2.</span><br>
<span><b>Step 9: </b> Now we have to manually check each answer of round 2.</span><br>
