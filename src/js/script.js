window.selectedClass = "";
window.selectedDate = "";

$("#classSelect").on('change', function(){
    $("#studentTable").hide();
    window.selectedClass = $(this).val();
    $("#dateSelect")
    .text("")
    .append("<option disabled hidden selected>Datum</option>")
    .prop("disabled", false);
    $.getJSON('getDates.php', {class: window.selectedClass}, function(data){
        $.each(data, function(index, item){
            const date = new Date(item);
            const days = ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"];
            const option = $("<option></option>")
            .text(`${days[date.getDay()]} ${date.getDate()}.${date.getMonth() + 1}.${date.getFullYear()}`)
            .prop("value", item);
            $("#dateSelect").append(option);
        });
    });
});

$("#dateSelect").on('change', function(){
    window.selectedDate = $(this).val();
    $.getJSON('getAbsences.php', {class: window.selectedClass, date: window.selectedDate}, function(data){
        $("#studentTableBody").text("");
        $.each(data, function(index, item){
            $("#studentTableBody")
            .append(`
              <tr>
                <th scope="row">${parseInt(index + 1)}</th>
                <td>${item.studentFirstname} ${item.studentLastname}</td>
                <td><input class="absenceSelect" type="radio" value="Anwesend" name="${item.studentId}" ${item.absenceType === "Anwesend" ? "checked" : "" }></td>
                <td><input class="absenceSelect" type="radio" value="Abgemeldet" name="${item.studentId}" ${item.absenceType === "Abgemeldet" ? "checked" : "" }></td>
                <td><input class="absenceSelect" type="radio" value="Fehlt" name="${item.studentId}" ${item.absenceType === "Fehlt" ? "checked" : "" }></td>
              </tr>
            `);
        });
        $("#studentTable").show();
        $(".absenceSelect").on('change', function(){
            $.post('insertAbsence.php', {class: window.selectedClass, date: window.selectedDate, studentId: this.name, absenceType: this.value});
        });
    });
});