$(".studentOpen").click(function () {
    $("div.studentForm").show("slow");
    $("div.counselorForm").hide("slow");
    $("div.institutionForm").hide("slow");
    $("div.loginForm").hide("slow");
});

$(".counselorOpen").click(function () {
    $("div.counselorForm").show("slow");
    $("div.studentForm").hide("slow");
    $("div.institutionForm").hide("slow");
    $("div.loginForm").hide("slow");
});

$(".institutionOpen").click(function () {
    $("div.institutionForm").show("slow");
    $("div.counselorForm").hide("slow");
    $("div.studentForm").hide("slow");
    $("div.loginForm").hide("slow");
});

$(".loginOpen").click(function () {
    $("div.loginForm").show("slow");
    $("div.institutionForm").hide("slow");
    $("div.counselorForm").hide("slow");
    $("div.studentForm").hide("slow");
});


$(".Hide-1").click(function() {
    $(".div-1").hide("slow");
});

var form = document.getElementById("formID");
function handleForm(event) { event.preventDefault(); } 
form.addEventListener('submit', handleForm);