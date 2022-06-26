<?php
    require_once("../../../config.php");
    require_once("class/mdl_activequiz_sessions.php");
    require_once("class/mdl_activequiz_attempt.php");
    require_once("class/mdl_question_attempts.php");
    require_once("class/mdl_question_attempt_steps.php");
    require_once("class/mdl_question_attempt_step_data.php");
  //require_once("class/chart_builder.php");
  //require_once("class/single_choice.php");
  //require_once("class/truefalsechoice.php");
    global $DB;

    // Parameter
    $charttype = "bar";//optional_param('type', false, PARAM_TEXT); //
    $sessionid = 28;//optional_param('sessionid', false, PARAM_TEXT); //$sessionID = 46;
    //$chart = new chart_builder();

    # # # # # # # # -SESSION- # # # # # # # #
    $session = new activequiz_session($sessionid);
    ##########################################

    # # # # # # # #  -ACTIVE-QUIZ ATTEMPTS- # # # # # # # #
    $activequiz_attempt = new activequiz_attempt($sessionid);
    $allquestionengids = $activequiz_attempt->getAllQuestionengids();

echo "<pre>";
print_r($allquestionengids);
echo "</pre>";

echo "<pre>";
print_r($allquestionengids);
echo "</pre>";

$slot = $session->getCurrentquestion(); // SLOT

$question_attemp = new question_attempts($allquestionengids, $slot);


echo "<pre>";
print_r($question_attemp);
echo "</pre>";






$answers = $question_attemp->getListOfAnswers();


echo "<pre>";
print_r($answers);
echo "</pre>";


// LISTE OF questionattemptids
$questionattemptids = array();
foreach ($answers as $answer) {
    array_push($questionattemptids, $answer[0]->getId());
}



$steps = array();
$step_ids = array();
foreach ($questionattemptids as $questionattemptid) {
    $step = new attempt_steps($questionattemptid);
    echo $step->getId();
    array_push($step_ids,$step->getId());
    array_push($steps,$step);
}




echo "<pre>";
print_r($step_ids);
echo "</pre>";





$steps_data = array();

foreach ($step_ids as $step_id) {
    $step_data = new attempt_step_data($step_id);
    array_push($steps_data,$step_data);
}


echo "<pre>";
print_r($steps_data);
echo "</pre>";






/*

echo "<pre>";
print_r($steps);
echo "</pre>";
//$steps = $steps->getAttemptstepids();

*/

#######################################################

/*
     # # # # # # # #  -QUESTION ATTEMPTS- # # # # # # # #
    $slot = $session->getCurrentquestion(); // SLOT
   // $slot = optional_param('slot', false, PARAM_TEXT); //; // SLOT
    $question_attemp = new question_attempts($allquestionengids, $slot);
    #####################################################

    $answers = $question_attemp->getListOfAnswers();

    $steps = new attempt_steps($answers);
    $steps = $steps->getAttemptstepids();

    $steps_data = new attempt_step_data($steps);
    $steps_data = $steps_data->getStepDataList();




    $questionType = "singel";
    $single = new single_choice();
    $trueFalse = new true_false_choice();
    $data = null;
    $msg = $answers;

    switch ($questionType) {
        case "singel":
            $single->load_quiz_data($answers,$steps_data);
            $msg =  "";


            foreach ($steps_data as $summary) {
                $responsesummary = $summary->getAnswer();
                $msg .=  $steps->getAttemptstepids;
                $msg .=  $responsesummary;
            }


        //    $data = $chart->build_new_chart($charttype, $single->getLabels(), $single->getValues(), $msg);
            break;
        case "true/false":
            $trueFalse->setData($answers[0]);
           // $data = $chart->build_new_chart($charttype, $single->getLabels(), $single->getValues(), $msg);
        default:
       //     $chart->setInfo("no Question Type Found!");
        //    $data = $chart->build_new_chart(null, null, null, null);
    }

    http_response_code($chart->getResponseCode());
    header('Content-Type: application/json');

//echo json_encode($data, JSON_PRETTY_PRINT);
//exit;

*/


