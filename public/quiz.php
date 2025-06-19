<?php 
$page = 'quiz';
include_once '../templates/header.php';
include_once('../src/config/db.php');
$account_id = $_SESSION['account_id'] ?? null;
if(!$account_id) header("Location: /whatnext/public/login.php");

class Question
{   
    public $question;
    public $options;
    public $answerchoosen;
    public $visited;
    public $answered;

    function __construct()
    {
        $this->visited = false;
        $this->answered = false;
        $this->options = array();
        $this->answerchoosen = null;
    }

    function setquestion($questionText)
    {
        $this->question = $questionText;
    }

    function setoptionwholly($option1, $trait1, $option2, $trait2, $option3, $trait3, $option4, $trait4)
    {
        $this->options[0] = array($option1, $trait1);
        $this->options[1] = array($option2, $trait2);
        $this->options[2] = array($option3, $trait3);
        $this->options[3] = array($option4, $trait4);
    }

    function setoption($index, $option)
    {
        $this->options[$index] = $option;
    }

    function setanswer($answer)
    {
        $this->answerchoosen = $answer;
        $this->answered = true;
    }
}

// Initialize questions
$q1 = new Question();
$q1->setquestion("You're starting a new project. What's your first step?");
$q1->setoptionwholly("Break the problem down into logical parts", 1, "Sketch or brainstorm creative ideas", 2, "Call a friend to discuss the approach", 3, "Create a checklist and timeline", 4);

$q2 = new Question();
$q2->setquestion("Your friend's bike has a strange noise. How do you help?");
$q2->setoptionwholly("Diagnose the problem by testing gears and chain tension", 1, "Suggest custom modifications (e.g., paint, decorations)", 2, "Chat with them while trying fixes together", 3, "Grab tools and disassemble the problem area", 5);

$q3 = new Question();
$q3->setquestion("What type of task do you enjoy the most?");
$q3->setoptionwholly("Solving logic puzzles or analyzing data", 1, "Writing, designing, or painting", 2, "Coaching or explaining ideas", 3, "Labeling, planning, or organizing files", 4);

$q4 = new Question();
$q4->setquestion("Your teacher gives a group assignment. What role do you take?");
$q4->setoptionwholly("Lead researcher who finds facts", 1, "Presentation designer", 2, "Presenter or team communicator", 3, "Project manager tracking progress", 4);

$q5 = new Question();
$q5->setquestion("You're learning something new. What helps you most?");
$q5->setoptionwholly("Understanding the theory behind it", 1, "Step-by-step instructions and diagrams", 4, "Discussing it with others", 3, "Trying it out by doing", 5);

$q6 = new Question();
$q6->setquestion("Which elective would you choose?");
$q6->setoptionwholly("Robotics", 5, "Creative writing or design", 2, "Psychology or sociology", 3, "Economics or statistics", 1);

$q7 = new Question();
$q7->setquestion("You're asked to organize a charity event. What's your focus?");
$q7->setoptionwholly("Budgeting and data tracking", 1, "Theme and promotion visuals", 2, "Volunteer coordination", 3, "Scheduling and logistics", 4);

$q8 = new Question();
$q8->setquestion("In a science class, what activity excites you most?");
$q8->setoptionwholly("Running experiments", 5, "Designing infographics or 3D models to explain concepts", 2, "Explaining findings to others", 3, "Writing lab reports or analyzing results", 1);

$q9 = new Question();
$q9->setquestion("Your dream workspace is:");
$q9->setoptionwholly("A quiet desk with graphs and tools", 1, "A vibrant room with markers and canvases", 2, "A classroom or discussion circle", 3, "A lab or workshop full of tools", 5);

$q10 = new Question();
$q10->setquestion("What motivates you to finish a task?");
$q10->setoptionwholly("Solving it smartly", 1, "Making it beautiful or expressive", 2, "Helping others benefit", 3, "Crossing items off a to-do list", 4);

$q11 = new Question();
$q11->setquestion("You've got a full day ahead. How do you plan it?");
$q11->setoptionwholly("Block time slots for each task", 4, "Leave room for inspiration and flow", 2, "Include group study or calls", 3, "Start with hands-on tasks first", 5);

$q12 = new Question();
$q12->setquestion("Your friend wants advice on a personal issue. What do you do?");
$q12->setoptionwholly("Analyze the cause and effects of the situation", 1, "Create a funny drawing to lighten the mood", 2, "Offer to talk and understand their feelings", 3, "Help them do something physical to relax", 5);

$q13 = new Question();
$q13->setquestion("Which tool feels most natural for you to use?");
$q13->setoptionwholly("Spreadsheet or programming IDE", 1, "Canva or Adobe Illustrator", 2, "Group chat or discussion board", 3, "Hammer, soldering iron, or toolkit", 5);

$q14 = new Question();
$q14->setquestion("Which feedback feels most satisfying?");
$q14->setoptionwholly("You're very smart and logical", 1, "You're so creative!", 2, "You're such a great listener", 3, "You're super organized", 4);

$q15 = new Question();
$q15->setquestion("What type of documentary would you enjoy?");
$q15->setoptionwholly("Crime solving or tech innovation", 1, "Arts and design trends", 2, "Human stories or therapy breakthroughs", 3, "Historical or economic systems", 4);

$q16 = new Question();
$q16->setquestion("What's your approach to failure?");
$q16->setoptionwholly("Review the process logically and try again", 1, "Change it creatively and explore new paths", 2, "Talk to someone about how it made you feel", 3, "Organize a plan to avoid the mistake next time", 4);

$q17 = new Question();
$q17->setquestion("Which statement describes you?");
$q17->setoptionwholly("I love building or assembling things", 5, "I'm always doodling or daydreaming", 2, "I enjoy managing group discussions", 3, "I keep my notes tidy and my files labeled", 4);

$q18 = new Question();
$q18->setquestion("You're given a blank whiteboard. What do you draw?");
$q18->setoptionwholly("A flowchart or system diagram", 1, "A colorful mural or scene", 2, "A community or network map", 3, "A schedule or timeline", 4);

$q19 = new Question();
$q19->setquestion("Your ideal team has:");
$q19->setoptionwholly("Data crunchers and coders", 1, "Designers and storytellers", 2, "Communicators and motivators", 3, "Planners and checklist masters", 4);

$q20 = new Question();
$q20->setquestion("You are offered three internships. Which one excites you most?");
$q20->setoptionwholly("Data science research assistant", 1, "Marketing design intern", 2, "Peer mentoring role", 3, "Workshop technician", 5);

$questions = array($q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10, $q11, $q12, $q13, $q14, $q15, $q16, $q17, $q18, $q19, $q20);

// Initialize session data if not exists
if(!isset($_SESSION['reset'] )) {

    $_SESSION['reset'] = false;
    
}
if(!isset($_SESSION['quiz_answers'] )) {
    $_SESSION['quiz_answers'] = array();
   
    
}
if (!isset($_SESSION['user_traits'])) {
    $_SESSION['user_traits'] = array(0, 0, 0, 0, 0);
}
if (!isset($_SESSION['current_question'])) {
    $_SESSION['current_question'] = 0;
}

// Function to recalculate traits from all answers
function recalculate_traits() {
    global $questions;
    $_SESSION['user_traits'] = array(0, 0, 0, 0, 0);
    
    foreach ($_SESSION['quiz_answers'] as $questionIndex => $traitValue) {
        if ($traitValue >= 1 && $traitValue <= 5) {
            $_SESSION['user_traits'][$traitValue - 1]++;
        }
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $current = $_SESSION['current_question'];
        
        // Save current answer if provided
        if (isset($_POST['answer'])) {
            $traitValue = intval($_POST['answer']);
            $_SESSION['quiz_answers'][$current] = $traitValue;
            $questions[$current]->setanswer($traitValue);
            
            // Recalculate traits to ensure accuracy
            recalculate_traits();
        }
        
        // Handle navigation
        if ($_POST['action'] === 'next') {
            if ($current < count($questions) - 1) {
                $_SESSION['current_question']++;
            }
        } elseif ($_POST['action'] === 'prev') {
            if ($current > 0) {
                $_SESSION['current_question']--;
            }
        } elseif ($_POST['action'] === 'submit') {
            // Check if all questions are answered
            if (count($_SESSION['quiz_answers']) === count($questions)) {
                // Final recalculation before submitting
                recalculate_traits();
                include_once('./calculateresult.php');
                header('Location: result.php');
                exit;
            }
        }
    }
}

$currentQuestionIndex = $_SESSION['current_question'];
$currentQuestion = $questions[$currentQuestionIndex];
$currentAnswer = isset($_SESSION['quiz_answers'][$currentQuestionIndex]) ? $_SESSION['quiz_answers'][$currentQuestionIndex] : null;

// Update question object with saved answer
if ($currentAnswer !== null) {
    $currentQuestion->setanswer($currentAnswer);
}

// Helper functions
function render_circle($index, $status)
{
    if ($status == true) {
        echo '<div class="circle-answered"><img src="../public/assets/images/tick.svg" alt="tick"/></div>';
    } else {
        echo '<div class="circle"><p>' . ($index + 1) . '</p></div>';
    }
}

function is_question_answered($questionIndex)
{
    return isset($_SESSION['quiz_answers'][$questionIndex]);
}

function get_all_answers_count()
{
    return count($_SESSION['quiz_answers']);
}
?>

<main class="container"> 
    <div class="Title">
        <h1>Discover Your Perfect Major</h1>
        <p>Answer a few quick questions to find a major that fits your strengths.</p>
    </div>
    
    <div class="content">
        <div class="track-bar">
            <div class="steps">
                <?php for ($i = 0; $i < count($questions); $i++): ?>
                    <?php render_circle($i, is_question_answered($i)); ?>
                <?php endfor; ?>
            </div>
            <img src="../public/assets/images/line.svg" alt="separate line"/>
        </div>
        
        <form method="POST">
            <div class="Quiz-main">
                <div>
                    <p><?php echo htmlspecialchars($currentQuestion->question); ?></p>
                </div>

                <div class="options">
                    <?php for ($i = 0; $i < 4; $i++): ?>
                        <label class="choice">
                            <input type="radio" name="answer" value="<?php echo $currentQuestion->options[$i][1]; ?>"
                                   <?php echo ($currentAnswer == $currentQuestion->options[$i][1]) ? 'checked' : ''; ?> hidden>
                            <div class="circle"><p><?php echo chr(65 + $i); ?></p></div>
                            <p><?php echo htmlspecialchars($currentQuestion->options[$i][0]); ?></p>
                        </label>
                    <?php endfor; ?>
                </div>
                
                <div class="buttons">
                    <?php if ($currentQuestionIndex > 0): ?>
                        <button type="submit" name="action" value="prev" class="image-button">
                            <img src="../public/assets/images/Button-prev.svg" alt="Previous" />
                        </button>
                    <?php endif; ?>

                    <?php if ($currentQuestionIndex < count($questions) - 1): ?>
                        <button type="submit" name="action" value="next" class="image-button">
                            <img src="../public/assets/images/Button-next.svg" alt="Next" />
                        </button>
                    <?php else: ?>
                        <?php if ($currentQuestionIndex == count($questions) - 1): ?>
    <button id="submit-btn"
            type="submit"
            name="action"
            value="submit"
            class="image-button submit-btn"
            style="<?php echo (get_all_answers_count() === count($questions)) ? '' : 'display:none'; ?>">
        Submit Quiz
    </button>

    <button id="submit-disabled"
            type="button"
            class="image-button disabled"
            disabled
            style="<?php echo (get_all_answers_count() === count($questions)) ? 'display:none' : ''; ?>">
        Answer all questions to submit
    </button>
<?php endif; ?>


                    <?php endif; ?>
                </div>
                
                <div class="progress-info">
                    <p>Question <?php echo $currentQuestionIndex + 1; ?> of <?php echo count($questions); ?></p>
                    <p>Answered: <?php echo get_all_answers_count(); ?>/<?php echo count($questions); ?></p>
                </div>
            </div>
        </form>
    </div>

   <script>
    document.addEventListener("DOMContentLoaded", function () {
        const radios = document.querySelectorAll('input[name="answer"]');
        const submitBtn = document.getElementById('submit-btn');
        const disabledBtn = document.getElementById('submit-disabled');

        radios.forEach(radio => {
            radio.addEventListener("change", function () {
                // Mark current question as answered in JS
                const answeredCount = <?php echo count($_SESSION['quiz_answers']); ?>;
                const totalQuestions = <?php echo count($questions); ?>;

                // This counts the one just answered
                let updatedAnswered = answeredCount;
                const isAlreadyAnswered = <?php echo json_encode(isset($_SESSION['quiz_answers'][$currentQuestionIndex])); ?>;
                if (!isAlreadyAnswered) {
                    updatedAnswered += 1;
                }

                if (updatedAnswered === totalQuestions) {
                    if (submitBtn) submitBtn.style.display = "inline-block";
                    if (disabledBtn) disabledBtn.style.display = "none";
                }
            });
        });
    });
</script>

</main>
                        
<?php include '../templates/footer.php'; ?>