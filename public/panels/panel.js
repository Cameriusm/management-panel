let localeProperties = {
    applyLabel: "Ок",
    cancelLabel: "Отмена",
    fromLabel: "От",
    toLabel: "До",
    customRangeLabel: "Произвольный",
    daysOfWeek: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
    monthNames: [
        "Январь",
        "Февраль",
        "Март",
        "Апрель",
        "Май",
        "Июнь",
        "Июль",
        "Август",
        "Сентябрь",
        "Октябрь",
        "Ноябрь",
        "Декабрь",
    ],
    firstDay: 1,
};

$(document).ready(function () {
    $('input[name="unsubmitted-dates"]').daterangepicker(
        {
            locale: {
                ...localeProperties,
                format: "YYYY.MM.DD",
            },
            singleDatePicker: true,
        },
        function (start, end, label) {
            $("#date").val(start.format("YYYY-MM-DD"));
            // console.log(start.format("YYYY-MM-DD"));
            // let sortedUsers = users.filter((e) => {
            //     if (
            //         e.reports.filter((e) => {
            //             let reportDate = e.created_at.split("T")[0];
            //             console.log(reportDate == start.format("YYYY-MM-DD"));
            //             return reportDate == start.format("YYYY-MM-DD");
            //         }).length < 1
            //     ) {
            //         return false;
            //     } else {
            //         return true;
            //     }
            // });
            // let sortedUsersIds = sortedUsers.map((e) => e.id);
            // console.log(sortedUsersIds);
            // jQuery(".staff-row").each(function () {
            //     var staff_id = $(this).find(".staff-id").html();
            //     if (sortedUsersIds.includes(+staff_id)) {
            //         let reportId = sortedUsers
            //             .filter((e) => e.id == +staff_id)[0]
            //             .reports.filter(
            //                 (e) =>
            //                     e.created_at.split("T")[0] ==
            //                     start.format("YYYY-MM-DD")
            //             )[0].id;
            //         console.log(reportId);
            //         $(this).find(".staff-buttons").empty();
            //         $(this).find(".staff-buttons").html(`
            //             <button name="check-report" title="Посмотреть отчёт" class=" d-inline btn btn-info btn-detail btn-sm btn_add open_modal_report m-2" data-toggle="tooltip" value="${reportId}">
            //           <i class="fas fa-eye">
            //           </i>
            //         </button>
            //        <a href="reports/${reportId}/edit">
            //         <button name="edit-report" title="Редактировать отчёт" class=" d-inline btn btn-info btn-detail btn-sm m-2" data-toggle="tooltip">
            //         <i class="fas fa-pencil-alt">
            //         </i>
            //       </button>
            //       </a>
            //       `);
            //         console.log("Correct Date");
            //         $(this).attr("hidden", false);
            //     } else {
            //         console.log("Outside the range!");
            //         $(this).attr("hidden", true);
            //     }
            // });
        }
    );
    $('input[name="created_at"]').daterangepicker(
        {
            locale: {
                ...localeProperties,
                format: "YYYY-MM-DD hh:mm:ss",
            },
            timePicker: true,
            timePickerSeconds: true,
            timePicker24Hour: true,
            singleDatePicker: true,
        },
        function (start, end, label) {
            $("#start").val(start.format("YYYY-MM-DD"));
            $("#end").val(end.format("YYYY-MM-DD"));
            console.log(start.format("YYYY-MM-DD"));
        }
    );
    $('input[name="dates"]').daterangepicker(
        {
            locale: {
                ...localeProperties,
                format: "YYYY.MM.DD",
            },
        },
        function (start, end, label) {
            $("#start").val(start.format("YYYY-MM-DD"));
            $("#end").val(end.format("YYYY-MM-DD"));
            jQuery(".report-row").each(function () {
                var reportDate = $(this).find(".report-date").html();
                if (
                    reportDate >= start.format("YYYY-MM-DD") &&
                    reportDate <= end.format("YYYY-MM-DD")
                ) {
                    console.log("Correct Date");
                    $(this).attr("hidden", false);
                } else {
                    console.log("Out Side range !!");
                    $(this).attr("hidden", true);
                }
            });
        }
    );
    $(function () {
        $('[data-toggle="tooltip"]')
            .tooltip()
            .mouseleave(function () {
                $(this).tooltip("hide");
            });
    });
    $(".nav-treeview .nav-link, .nav-link").each(function () {
        var location2 =
            window.location.protocol +
            "//" +
            window.location.host +
            window.location.pathname;
        var link = this.href;
        if (link == location2) {
            $(this).addClass("active");
            $(this)
                .parent()
                .parent()
                .parent()
                .addClass("menu-is-opening menu-open");
        }
    });

    var url = $("#url").val();

    //display modal form for product EDIT ***************************
    $(document).on("click", ".open_modal_report", function () {
        let report_id = $(this).val();
        // console.log(report_id);
        $.ajax({
            type: "GET",
            url: "http://localhost/panel/reports/" + report_id,
            dataType: "json",
            success: function (data) {
                let d = new Date(data.created_at);
                dformat =
                    [d.toISOString().slice(0, 10)].join("-") +
                    " " +
                    [d.toLocaleTimeString("en-IT", { hour12: false })];
                console.log(data);
                $("#myModalLabel").html(`Отчёт номер ${data.id}`);
                $("#created_at").val(dformat);
                $("#desc").val(data.desc);
                $("#created_at").attr("hidden", false);
                $("#created_at").datepicker("option", "disabled", true);
                $("#created_at").prop("readonly", "readonly");
                $("#desc").prop("required", false);
                $("#desc").prop("readonly", true);
                $("#btn-add").attr("hidden", true);
                $("#myModal").modal("show");
            },
            error: function (data) {
                console.log("Error:", data);
            },
        });
    });
    $(document).on("click", ".open_modal", function () {
        var user_id = $(this).val();

        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + "/" + user_id,
            success: function (data) {
                console.log(data);
                $("#user_id").val(data.id);
                $("#name").val(data.name);
                $("#email").val(data.email);
                $(`#role option[value=${data.role_id}]`).attr(
                    "selected",
                    "selected"
                );
                $("#btn-save").val("update");
                $("#myModal").modal("show");
            },
            error: function (data) {
                console.log("Error:", data);
            },
        });
    });
    $(document).on("click", ".open_modal_create", function () {
        let user_id = $(this).val();
        console.log(user_id);

        let d = new Date();
        dformat =
            [d.toISOString().slice(0, 10)].join("-") +
            " " +
            [d.toLocaleTimeString("en-IT", { hour12: false })];
        console.log(d);
        $("#btn-add").attr("hidden", false);
        $("#created_at").prop("readonly", false);
        $("#desc").prop("readonly", false);
        $("#desc").prop("required", true);
        $("#user_id").val(user_id);
        $("#desc").val("");
        $("#myModalLabel").html(`Создание отчёта сотрудника ${user_id}`);
        $("#myModal").modal("show");
    });

    //create new product / update existing product ***************************
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        e.preventDefault();
        var user_id = $("#user_id").val();
        var formData = {
            role_id: $("#role").val(),
        };
        var role_id = $("#role").val();
        var state = $("#btn-save").val();
        var type = "POST"; //for creating new resource
        var my_url = url;
        if (state == "update") {
            type = "PUT"; //for updating existing resource
            my_url += "/" + user_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#frmProducts").trigger("reset");
                console.log(role_id);
                switch (role_id) {
                    case "1":
                        $(`#th-${user_id}`).html("Гость");
                        break;
                    case "2":
                        $(`#th-${user_id}`).html("Работник");
                        break;
                    case "3":
                        $(`#th-${user_id}`).html("Менеджер");
                        break;
                    case "4":
                        $(`#th-${user_id}`).html("Администратор");
                        break;
                    default:
                        break;
                }
                $("#myModal").modal("hide");
            },
            error: function (data) {
                console.log("Error:", data);
            },
        });
    });
    $("#formModal").submit(function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        e.preventDefault();
        if ($("#desc").val() == "") {
            $(".desc-form").append(
                `<p class="text-danger">Поле обязательно</p>`
            );
            return;
        }
        var user_id = $("#user_id").val();
        var formData = {
            user_id: user_id,
            created_at: $("#created_at").val(),
            desc: $("#desc").val(),
        };
        var type = "POST";
        var my_url = "http://localhost/panel/reports";
        console.log(formData);
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#myModal").modal("hide");
            },
            error: function (error) {
                location.reload();
            },
        });
    });
});
$(".role-selector").on("change", "", function (e) {
    var valueSelected = this.value;
    console.log(valueSelected);
    jQuery(".staff-row").each(function () {
        if (valueSelected != $(this).find("input[name=role_id]").val()) {
            $(this).attr("hidden", true);
        } else {
            $(this).attr("hidden", false);
        }
    });
});
