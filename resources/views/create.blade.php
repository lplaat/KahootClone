<x-app-layout>
    <x-slot name="header">
        <h2 class="p-3 mb-0">
            {{ __('Make quiz') }}
        </h2>
    </x-slot>
    <div class="p-3">
        <div>
            <form method="post" id="createForm">
                <div id="questions">
                    <div class="bg-light-subtle p-3 rounded" id="1">
                        <div class="max-w-xl">
                            <label for="1">Question 1</label>
                            <input type="text" class="form-control" id="1" name="questions[]">
                        </div>
                        <x-primary-button type="button" class="addAnswer">{{__("Add answer")}}</x-primary-button>
                        <div id="answers">
                        </div>
                    </div>
                </div>
                <x-primary-button type="button" id="addQuestion">{{__("Add question")}}</x-primary-button>
                <x-primary-button type="button" id="makeQuiz">{{__("Make quiz")}}</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
<script>
    let maxAnswers = 4;
    let answers = 1;
    let questions = 1;
    $(".addAnswer").on("click", function(){
        answers = $(this).parent().find("#answers").children().length + 1;
        if (answers <= 4 ) {
            $(this).parent().find("#answers").append('<div>Answer ' + answers + '<br> <input type="text" name="answers[question ' + $(this).parent().attr("id") +']" class="form-control" style="width: 90%; display: initial;"> <button type="button" onclick="removeAnswer(this)" class="btn btn-danger mb-1"><i class="bi bi-trash"></i></button></div>');
            answers++;
        }
    });
    
    $("#addQuestion").on("click", function(){
        questions++;
        let question = $("#1").clone(true);
        question.find("label").attr("for", questions).html("Question" + questions);
        question.find("#answers").empty();
        question.attr("id", questions);
        $("#questions").append(question);
    });

    function removeAnswer(element) {
        $(element).parent().remove();
        answers--;
    }

    $("#makeQuiz").on("click", function (){
        let answerArray = {};
        let questionArray = {
            "questions" : []
        };
        
        $("[name *= questions]").each(function() {
            json = {"question": $(this).val(), "answers": []}
            
            $(this).parent().parent().find("[name*=answers]").each(function () {
                json["answers"].push($(this).val());
            })
            
            questionArray["questions"].push(json);
            
        });
        
        $.ajax({
            url: "/create",
            method: "POST",
            data: questionArray,
            dataType: "json"
        })
    });

</script>