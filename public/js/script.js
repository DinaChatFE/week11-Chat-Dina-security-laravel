$(document).ready(function () {
    var valueArr = [];
    var valueData = [];

    var divList = $(".div-list");

    divList.click(function () {
        $(this).toggleClass("toggle-overflow");
    });

    var bagetext = $("#badge-text");
    $("#btn-selected").click(function (e) {
        e.preventDefault();
        var value = $("#categories").val();
        if (value !== "") {
            var splitValue = value.split("-");
            valueArr.push(splitValue[1]);
            valueData.push(parseInt(splitValue[0]));
            bagetext.append(
                `<span class="badge bg-secondary text-light mr-1">${splitValue[1]}</span>`
            );
            $("#test").val(valueData);
            // }
        }
    });
});
