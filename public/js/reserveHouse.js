let entryDate;
let exitDate;
$(function () {

    $.datepicker.setDefaults({

        format: "yy/mm/dd",
    });


    let entry = $("#entryDate").datepicker();
    let exit = $("#exitDate").datepicker();

    entry.on("change", function () {
        entryDate = entry.datepicker("getDate");
        entryDate =dateForm(entryDate, entry, exit)
    });

    exit.on("change", function () {

        exitDate = exit.datepicker("getDate");
        exitDate= dateForm(exitDate, exit, entry)

        console.log(exitDate)
    });

});

function dateForm(date, inputToDisable, inputToEnable) {
    if (date !== null) {
        inputToDisable.prop("disabled", true);
        inputToEnable.prop("disabled", false);
        return $.datepicker.formatDate("@", date);
    }
}
