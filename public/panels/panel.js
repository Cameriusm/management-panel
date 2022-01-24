$(document).ready(function () {
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

    // $('.delete-btn').click(function () {
    //     var res = confirm('Подтвердите действия');
    //     if(!res){
    //         return false;
    //     }
    // });
    //get base URL *********************
    var url = $("#url").val();

    //display modal form for creating new product *********************
    $("#btn_add").click(function () {
        $("#btn-save").val("add");
        $("#frmProducts").trigger("reset");
        $("#myModal").modal("show");
    });

    //display modal form for product EDIT ***************************
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

    //create new product / update existing product ***************************
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        // console.log($("#role").val());
        e.preventDefault();
        var user_id = $("#user_id").val();
        var formData = {
            // id: $("#user_id").val(),
            role_id: $("#role").val(),
        };
        var role_id = $("#role").val();
        // console.log(role_id);

        //used to determine the http verb to use [add=POST], [update=PUT]
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
            // data: { role_id: "2" },
            data: formData,
            dataType: "json",
            success: function (data) {
                console.log(data);
                var product =
                    '<tr id="product' +
                    data.id +
                    '"><td>' +
                    data.id +
                    "</td><td>" +
                    data.name +
                    "</td><td>" +
                    data.price +
                    "</td>";
                product +=
                    '<td><button class="btn btn-warning btn-detail open_modal" value="' +
                    data.id +
                    '">Edit</button>';
                product +=
                    ' <button class="btn btn-danger btn-delete delete-product" value="' +
                    data.id +
                    '">Delete</button></td></tr>';
                if (state == "add") {
                    //if user added a new record
                    $("#products-list").append(product);
                } else {
                    //if user updated an existing record
                    $("#product" + user_id).replaceWith(product);
                }
                $("#frmProducts").trigger("reset");
                // $(`#th-${user_id}`).html("Гость");
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

    //delete product and remove it from TABLE list ***************************
    $(document).on("click", ".delete-product", function () {
        var user_id = $(this).val();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
            },
        });
        $.ajax({
            type: "DELETE",
            url: url + "/" + user_id,
            success: function (data) {
                console.log(data);
                $("#product" + user_id).remove();
            },
            error: function (data) {
                console.log("Error:", data);
            },
        });
    });
});
