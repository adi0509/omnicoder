# omnicoder
This is a website made in PHP, and was used in Computer Science Department fest in Ramanujan College. Omnicoder is a event organised by us. In this event we have 2 rounds:

<b>Round-1</b> we have 20 MCQ round with negative marking of -1 for each wrong answer and +4 for each correct answer. All participants will register and start giving answer and at the end we have ranking page and selected students will get login credetial for next round. 

<b>Round-2</b> This round has 10 question, participant can use any one language for any one question. Those whose maximum are correct in minimum time will be a winner.

<h3>How to run omnicoder website after cloning</h3>

<span><b>Step 1: </b>Import <b>omnicoder.sql</b> to your xampp</span><br>
<span><b>Step 2: </b>Go to <b>./omnicoder/</b></span><br>
<span><b>Step 3: </b>Register and attempt round 1</span><br>
<span><b>Step 4: </b>After all participant had submitted their result, then we'll calculate result by running <b>./omnicoder2/calculateResult.php</b></span><br>
<span><b>Step 5: </b>go to <b>./omnicoder/result/index.php</b> and change <b>$noSelected</b>, number of students you want to select.</span><br>
<span><b>Step 6: </b>Now database will be updated with marks, now to get ranking go to <b>./omnicoder/result</b></span><br>
<span><b>Step 7: </b>Now those people who got selected will get a random login id and password.</span><br>
<span><b>Step 8: </b>Now go to <b>/omnicoder2/</b> and attempt round 2.</span><br>
<span><b>Step 9: </b> Now we have to manually check each answer of round 2.</span><br>
