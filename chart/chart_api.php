<?php
require_once("../../../config.php");
require_once("class/database/mdl_activequiz_sessions.php");
require_once("class/database/mdl_activequiz_attempt.php");
require_once("class/database/mdl_question.php");
require_once("class/database/mdl_question_attempts.php");
require_once("class/database/mdl_question_attempt_steps.php");
require_once("class/database/mdl_question_attempt_step_data.php");
require_once("class/chart_builder.php");
require_once("class/single_choice.php");
require_once("class/multi_choice.php");

global $DB;

// Parameter
$charttype = optional_param('type', false, PARAM_TEXT); //
$sessionid = optional_param('sessionid', false, PARAM_TEXT); //$sessionID = 46;
$chart = new chart_builder();

# # # # # # # # -SESSION- # # # # # # # #
$session = new activequiz_session($sessionid);
##########################################

# # # # # # # #  -ACTIVE-QUIZ ATTEMPTS- # # # # # # # #
$activequiz_attempt = new activequiz_attempt($sessionid);
$allquestionengids = $activequiz_attempt->getAllQuestionengids();
#######################################################

# # # # # # # #  -QUESTION ATTEMPTS- # # # # # # # #
$slot = $session->getCurrentquestion(); // SLOT
// $slot = optional_param('slot', false, PARAM_TEXT); //; // SLOT
$question_attemp = new question_attempts($allquestionengids, $slot);
#####################################################

$answers = $question_attemp->getListOfAnswers();

$questionid = $answers[0][0]->getQuestionid();



// LISTE OF questionattemptids
$questionattemptids = array();
foreach ($answers as $answer) {
    array_push($questionattemptids, $answer[0]->getId());
}



$steps = array();
$step_ids = array();

foreach ($questionattemptids as $questionattemptid) {
    $step = new attempt_steps($questionattemptid);
    $step = $step->getAnswerList();

    foreach ($step as $stepID) {
        array_push($step_ids, $stepID->getId());
    }

    array_push($steps,$step);
}


$steps_data = array();

foreach ($steps as $step) {
    $step_data = new attempt_step_data($step);
    array_push($steps_data,$step_data);
}



$current_question = new mdl_question($questionid);
$questionType = $current_question->getQtype();



$data = null;
$labels = $answer[0]->questionsummary;







switch ($questionType) {
    case "multichoice":
        $single = new single_choice($labels,$steps_data);
        $data = $chart->build_new_chart($charttype, $labels, $single->getValues());
        break;

    case "multichoicea":
        $multi = new multi_choice($labels,$steps_data);
        $data = $chart->build_new_chart($charttype, $multi->getLabels(), $multi->getValues());
        break;

    default:
        $chart->setInfo("no Question Type Found!");
        $data = $chart->build_new_chart(null, null, null);
}

/*
http_response_code($chart->getResponseCode());
header('Content-Type: application/json');

echo json_encode($data, JSON_PRETTY_PRINT);
exit;
*/
