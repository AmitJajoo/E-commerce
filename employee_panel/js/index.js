$(document).ready(function() {
    $(".stock-update-btn").click(function() {
        $(".stock-update-btn-menu").collapse("toggle");
    });

    $(".homepage-design-btn").click(function() {
        $(".homepage-design-collapse").collapse("toggle");
    });
});

//dynamic request
$(document).ready(function() {
    $(".collapse-item").each(function() {
        var active_link = $(".active").attr("access-link");

        dynamic_link(active_link);
        $(this).click(function() {
            var access_link = $(this).attr("access-link");
            dynamic_link(access_link);
        });
    });
});

$(document).ready(function() {
    var i;
    $(".collapse-item").each(function() {
        $(this).click(function() {

            for (i = 0; i < $(".collapse-item").length; i++) {
                $(".collapse-item").removeClass("active");
            }
            $(this).addClass("active");
        });
    });
});


function dynamic_link(request_link) {
    $.ajax({
        type: "POST",
        url: "dynamic_pages/" + request_link,
        xhr: function() {
            var request = new XMLHttpRequest();
            request.onprogress = function(e) {
                var percentage = Math.floor((e.loaded * 100) / e.total);
                var loader = '<center><button class="btn btn-danger p-3" style="font-size: 30px;"><i class="fa fa-circle-o-notch fa-spin"></i> Loading <span>' + percentage + '%</span></button></center>';
                $(".page").html(loader);
            }
            return request;
        },
        cache: false,
        beforeSend: function(response) {
            var loader = '<center><button class="btn btn-danger p-3" style="font-size: 30px;"><i class="fa fa-circle-o-notch fa-spin"></i></button></center>';
            $(".page").html(loader);
        },
        success: function(response) {
            $(".page").html(response);
            if (request_link == "header_showcase_design.php") {
                header_showcase();
            }
            if (request_link == "category_showcase_design.php") {
                category_showcase();
            }
            if (request_link == "branding_details.php") {
                branding_information();
            }
            if (request_link == "delivery_area.php") {
                delivery();
            }
            //create products
            $(".create-products-form").submit(function(e) {
                e.preventDefault();
                var option = $(".brands-name option");
                var i;
                var c_name = "";
                for (i = 0; i < option.length; i++) {
                    if (option[i].innerHTML == $(".brands-name").val()) {
                        c_name = $(option[i]).attr("c-name");
                    }
                }

                if ($(".brands-name").val() != "Choose Category") {
                    $.ajax({
                        type: "POST",
                        url: "php/create_products.php?c_name=" + c_name,
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        cache: false,
                        xhr: function() {
                            var request = new XMLHttpRequest();
                            request.upload.onprogress = function(e) {
                                var percentage = Math.floor((e.loaded * 100) / e.total);
                                $(".create-products-progess progress-bar").html(percentage + "%");
                                $(".create-products-progess progress-bar").css({
                                    width: percentage + "%"
                                });
                            }
                            return request;
                        },
                        beforeSend: function(r) {

                            $(".create-products-progess").removeClass("d-none");
                        },
                        success: function(response) {

                            if (response.trim() == "success") {
                                $(".create-products-progess").addClass("d-none");
                                $(".create-products-progess progress-bar").css({
                                    width: '0%'
                                });
                                $(".create-products-form").trigger('reset');
                            } else {
                                alert(response);
                            }
                        }
                    });
                } else {
                    alert("Please select category");
                }
            });
            if (request_link == "create_category_design.php") {
                category_list();
            }

            //display brands
            $(document).ready(function() {
                $(".display-brand").on("change", function() {
                    var selected_cat_name = $(this).val();
                    var all_cat_name = $(this).html().replace("<option>Choose Category</option>").replace("<option>" + selected_cat_name + "</option>");
                    $.ajax({
                        type: "POST",
                        url: "php/displays_brands.php",
                        data: {
                            cat_name: selected_cat_name
                        },
                        cache: false,
                        beforeSend: function() {
                            $(".display-brand-loader").removeClass("d-none");
                        },
                        success: function(response) {
                            $(".display-brand-loader").addClass("d-none");
                            if (response.trim() != "<b>No brands has been created yet in this category</b>") {

                                var table = document.createElement("TABLE");
                                table.width = "100%";
                                table.border = "1";
                                table.className = "text-center";
                                var top_tr = document.createElement("tr");
                                var th_cat = document.createElement("th");
                                th_cat.innerHTML = "CATEGORY";
                                th_cat.height = "40";
                                th_cat.className = "bg-danger text-light text-center";
                                var th_brands = document.createElement("th");
                                th_brands.innerHTML = "BRANDS";
                                th_brands.height = "40";
                                th_brands.className = "bg-danger text-light text-center";
                                var th_edit = document.createElement("th");
                                th_edit.innerHTML = "EDIT";
                                th_edit.height = "40";
                                th_edit.className = "bg-danger text-light text-center";
                                var th_delete = document.createElement("th");
                                th_delete.innerHTML = "DELETE";
                                th_delete.height = "40";
                                th_delete.className = "bg-danger text-light text-center";
                                top_tr.append(th_cat);
                                top_tr.append(th_brands);
                                top_tr.append(th_edit);
                                top_tr.append(th_delete);
                                table.append(top_tr);

                                var json_data = JSON.parse(response);
                                var i;
                                for (i = 0; i < json_data.length; i++) {
                                    console.log(json_data[i].brands);
                                    var tr = document.createElement("tr");
                                    var td_cat = document.createElement("td");
                                    var td_brands = document.createElement("td");
                                    var td_edit = document.createElement("td");
                                    var td_delete = document.createElement("td");


                                    td_cat.innerHTML = "<select disabled='disabled' class='border p-2 w-75 dynamic-c-name'><option>" + json_data[i].category_name + "</option>" + all_cat_name + "</select>";
                                    td_brands.innerHTML = json_data[i].brands;
                                    td_edit.innerHTML = "<i class='fa fa-edit brand-edit' b-name='" + json_data[i].brands + "' c-name='" + json_data[i].category_name + "'></i><i class='fa fa-save d-none brand-save' b-name='" + json_data[i].brands + "' c-name='" + json_data[i].category_name + "'></i>";
                                    td_delete.innerHTML = "<i class='fa fa-trash brand-delete' b-name='" + json_data[i].brands + "' c-name='" + json_data[i].category_name + "'></i>";

                                    table.append(tr);
                                    tr.append(td_cat);
                                    tr.append(td_brands);
                                    tr.append(td_edit);
                                    tr.append(td_delete);


                                    $(".brand-list-area").html(table);
                                    //delete brand
                                    $(".brand-delete").each(function() {
                                        $(this).click(function() {
                                            var parent_elem = this.parentElement.parentElement;
                                            var c_name = $(this).attr("c-name");
                                            var b_name = $(this).attr("b-name");
                                            $.ajax({
                                                type: "POST",
                                                url: "php/delete_brands.php",
                                                data: {
                                                    c_name: c_name,
                                                    b_name: b_name
                                                },
                                                success: function(response) {
                                                    if (response.trim() == "Delete success") {
                                                        parent_elem.remove();
                                                    } else {
                                                        $(".brand-list-area").html(response);
                                                    }
                                                }
                                            });
                                        });
                                    });

                                    //brand edit
                                    $(".brand-edit").each(function() {
                                        $(this).click(function() {
                                            var edit_icon = this;
                                            $(this).addClass("d-none");
                                            var c_name = $(this).attr("c-name");
                                            var b_name = $(this).attr("b-name");
                                            var row = this.parentElement.parentElement;
                                            var td = row.getElementsByTagName("TD");
                                            var select_tag = td[0].getElementsByClassName("dynamic-c-name")[0];
                                            select_tag.disabled = false;
                                            td[1].contentEditable = true;
                                            td[1].focus();
                                            var delete_icon = td[3].getElementsByClassName("brand-save")[0];
                                            var save_icon = td[2].getElementsByClassName("brand-save")[0];
                                            $(save_icon).removeClass("d-none");

                                            save_icon.onclick = function() {
                                                // alert("amitj");
                                                // alert(c_name);
                                                // alert(b_name);
                                                // alert(select_tag.value);
                                                // alert(td[1].innerHTML);
                                                $.ajax({
                                                    type: "POST",
                                                    url: "php/edit_brand.php",
                                                    data: {
                                                        previous_c_name: c_name,
                                                        previous_b_name: b_name,
                                                        c_name: select_tag.value,
                                                        b_name: td[1].innerHTML

                                                    },
                                                    success: function(response) {
                                                        console.log(response);
                                                        if (response.trim() == "success") {
                                                            $(save_icon).addClass("d-none");
                                                            $(edit_icon).removeClass("d-none");
                                                            td[1].contentEditable = false;
                                                            select_tag.disabled = true;
                                                            $(edit_icon).attr("c-name", select_tag.value);
                                                            $(edit_icon).attr("b-name", td.innerHTML);

                                                            $(save_icon).attr("c-name", select_tag.value);
                                                            $(save_icon).attr("b-name", td.innerHTML);

                                                            $(delete_icon).attr("c-name", select_tag.value);
                                                            $(delete_icon).attr("b-name", td.innerHTML);
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    });

                                }
                            } else {
                                $(".brand-list-area").html(response);

                            }
                        }
                    });
                });
            });

            //add more input box
            $(".add-field-btn").click(function() {
                var placeholder = $(".input:first").attr("placeholder");
                var input = document.createElement("INPUT");
                input.type = "text";
                input.className = "input form-control mb-3 w-100";
                input.required = "required";
                input.placeholder = placeholder;
                input.style.background = "#f9f9f9";
                input.style.border = "none";
                $(".add-field-area").append(input);
            });

            $(".create-btn").click(function(e) {
                e.preventDefault();

                var input = [];
                var input_length = $(".input").length;
                var i;
                for (i = 0; i < input_length; i++) {
                    input[i] = document.getElementsByClassName("input")[i].value;
                }

                var json_string = JSON.stringify(input);
                $.ajax({
                    type: "POST",
                    url: "php/create_category.php",
                    data: {
                        json_data: json_string
                    },
                    cache: false,
                    beforeSend: function() {
                        $(".create-category-loader").removeClass("d-none");
                    },
                    success: function(response) {
                        $(".create-category-loader").addClass("d-none");
                        if (response.trim() == "Done") {
                            category_list();
                            var notice = document.createElement("DIV");
                            notice.className = "alert alert-success";
                            notice.innerHTML = "<b>Success !</b>";
                            $(".create-category-notice").html(notice);
                            setTimeout(function() {
                                $(".create-category-notice").html("");
                                $(".create-category-form").trigger('reset');
                            }, 3000);
                        } else {
                            var notice = document.createElement("DIV");
                            notice.className = "alert alert-warning";
                            notice.innerHTML = "<b>" + response + "</b>";
                            $(".create-category-notice").html(notice);
                            setTimeout(function() {
                                $(".create-category-notice").html("");
                                $(".create-category-form").trigger('reset');
                            }, 3000);
                        }
                    }
                });
            });
            //add brand field
            $(".add-brand-btn").click(function() {
                var placeholder = $(".brand-input:first").attr("placeholder");
                var input = document.createElement("INPUT");
                input.type = "text";
                input.className = "brand-input form-control mb-3 w-100";
                input.required = "required";
                input.placeholder = placeholder;
                input.style.background = "#f9f9f9";
                input.style.border = "none";
                $(".brand-field-area").append(input);
            });

            $(".create-brand-btn").click(function(e) {
                e.preventDefault();
                var category = $(".select_category").val();
                if (category == "Choose Category") {
                    var notice = document.createElement("DIV");

                    notice.className = "alert alert-warning";
                    notice.innerHTML = "<b>Please choose a category!</b>";
                    $(".brand-field-notice").html(notice);
                    setTimeout(function() {
                        $(".brand-field-notice").html("");
                        $(".brand-form").trigger('reset');
                    }, 3000);
                } else {
                    var input = [];
                    var input_length = $(".brand-input").length;
                    var i;
                    for (i = 0; i < input_length; i++) {
                        input[i] = document.getElementsByClassName("brand-input")[i].value;
                    }

                    var json_string = JSON.stringify(input);

                    $.ajax({
                        type: "POST",
                        url: "php/create_brand.php",
                        data: {
                            json_data: json_string,
                            category: category
                        },
                        cache: false,
                        beforeSend: function() {
                            $(".brand-loader").removeClass("d-none");
                        },
                        success: function(response) {
                            $(".brand-loader").addClass("d-none");
                            if (response.trim() == "Done") {

                                var notice = document.createElement("DIV");
                                notice.className = "alert alert-success";
                                notice.innerHTML = "<b>Success !</b>";
                                $(".brand-field-notice").html(notice);
                                setTimeout(function() {
                                    $(".brand-field-notice").html("");
                                    $(".brand-form").trigger('reset');
                                }, 3000);
                            } else {
                                var notice = document.createElement("DIV");
                                notice.className = "alert alert-warning";
                                notice.innerHTML = "<b>" + response + "</b>";
                                $(".brand-field-notice").html(notice);
                                setTimeout(function() {
                                    $(".brand-field-notice").html("");
                                    $(".brand-form").trigger('reset');
                                }, 3000);
                            }
                        }
                    });
                }
            });

        }
    });
}


//category list name
$(document).ready(function() {
    category_list();
});

function category_list() {
    $.ajax({
        type: "POST",
        url: "php/create_list.php",
        cache: false,
        success: function(response) {
            var category_list = JSON.parse(response);
            var i;

            for (i = 0; i < category_list.length; i++) {
                var id = category_list[i].id;
                var name = category_list[i].category_name;
                var ul = document.createElement("UL");
                ul.className = "list-group";
                var li = document.createElement("LI");
                li.className = "list-group-item border-0 mb-3";
                ul.append(li);
                var div = document.createElement("DIV");
                div.className = "btn-group";
                li.append(div);

                var id_btn = document.createElement("BUTTON");
                id_btn.innerHTML = id;
                id_btn.className = "btn btn-danger id";
                div.append(id_btn);

                var name_btn = document.createElement("BUTTON");
                name_btn.innerHTML = name;
                name_btn.className = "btn btn-dark name";
                div.append(name_btn);

                var edit_btn = document.createElement("BUTTON");
                edit_btn.innerHTML = "<i class='fa fa-edit edit-icon'></i><i class='fa fa-save d-none save-icon'></i>";
                edit_btn.className = "btn btn-info";
                div.append(edit_btn);

                var delete_btn = document.createElement("BUTTON");
                delete_btn.innerHTML = "<i class='fa fa-trash'></i>";
                delete_btn.className = "btn btn-danger delete-btn";
                div.append(delete_btn);

                $(".category_area").append(ul);

                //edit category name
                edit_btn.onclick = function() {
                    var parent = this.parentElement;
                    var id = parent.getElementsByClassName("id")[0];
                    var cat_name = parent.getElementsByClassName("name")[0];
                    var save_icon = parent.getElementsByClassName("save-icon")[0];
                    var edit_icon = parent.getElementsByClassName("edit-icon")[0];
                    cat_name.contentEditable = true;
                    cat_name.focus();
                    $(edit_icon).addClass("d-none");
                    $(save_icon).removeClass("d-none");

                    $(save_icon).click(function() {
                        var change_name = cat_name.innerHTML.trim();
                        $.ajax({
                            type: "POST",
                            url: "php/edit_category_name.php",
                            data: {
                                id: id.innerHTML.trim(),
                                change_name: change_name
                            },
                            cache: false,
                            success: function(response) {
                                if (response.trim() == "success") {
                                    cat_name.contentEditable = false;
                                    $(save_icon).addClass("d-none");
                                    $(edit_icon).removeClass("d-none");

                                } else {
                                    alert(response);
                                }
                            }
                        });
                    });

                }

                //delete category
                delete_btn.onclick = function() {
                    var parent = this.parentElement;
                    var id = parent.getElementsByClassName("id")[0].innerHTML.trim();
                    $.ajax({
                        type: "POST",
                        url: "php/delete_category_name.php",
                        data: {
                            id: id
                        },
                        cache: false,
                        success: function(response) {
                            if (response.trim() == "success") {
                                parent.parentElement.parentElement.remove();
                            } else {
                                alert(response);
                            }
                        }
                    });
                }
            }
        }
    });
}
// branding information
function branding_information() {
    // count number of text written
    $(document).ready(function() {
        $("#about-us").on("input", function() {
            var count = $(this).val().length;
            $(".about-us-count").html(count);
        });

        $("#privacy").on("input", function() {
            var count = $(this).val().length;
            $(".privacy-us-count").html(count);
        });

        $("#cookies").on("input", function() {
            var count = $(this).val().length;
            $(".cookies-us-count").html(count);
        });

        $("#terms").on("input", function() {
            var count = $(this).val().length;
            $(".terms-us-count").html(count);
        });


    });

    $(document).ready(function() {
        $(".branding-form").submit(function(e) {
            e.preventDefault();
            var file = document.querySelector("#logo");
            var size;
            if (file.value == "") {
                size = 0;
            } else {
                size = file.files[0].size;
            }
            if (200000 > size) {
                $.ajax({
                    type: "POST",
                    url: "php/branding.php",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(response) {
                        document.write(response);
                    }
                });
            } else {
                alert("Upload file size less than 200kb");
            }
        });
    });

    //branding details controls
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "php/check_branding_table.php",
            cache: false,
            success: function(response) {

                var all_data = JSON.parse(response.trim());
                $("#brand_name").val(all_data[0].brand_name);
                $("#domain").val(all_data[0].domain_name);
                $("#email").val(all_data[0].email);
                $("#facebook-url").val(all_data[0].facebook_url);
                $("#twitter-url").val(all_data[0].twitter_url);
                $("#address").val(all_data[0].addres);
                $("#phone").val(all_data[0].phone);
                $("#about-us").val(all_data[0].about_us);
                $("#privacy").val(all_data[0].privacy_policy);
                $("#cookies").val(all_data[0].cookies_policy);
                $("#terms").val(all_data[0].terms_policy);
                $(".branding-form button, .branding-form input, .branding-form textarea").prop("disabled", true);
                $(".branding-edit").click(function() {
                    $(".branding-form button, .branding-form input, .branding-form textarea").prop("disabled", false);
                });
            }
        });
    });
}


//header show case
function header_showcase() {
    $(document).ready(function() {
        $(".target").each(function() {
            $(this).click(function(event) {
                var element = event.target;
                var index_number = $(element).index();
                sessionStorage.setItem("get_color_index", index_number);
                var i;
                for (i = 0; i < $(".target").length; i++) {
                    $(".target").css({
                        border: "",
                        width: "",
                        padding: "",
                        boxShadow: ""
                    });
                }
                $(this).css({
                    border: "5px solid red",
                    width: "fit-content",
                    padding: "5px",
                    boxShadow: "0px 0px 3px grey"
                });

                $(this).on('dblclick', function() {
                    var i;
                    for (i = 0; i < $(".target").length; i++) {
                        $(".target").css({
                            border: "",
                            width: "",
                            padding: "",
                            boxShadow: ""
                        });
                    }
                });
            });
        });

        $(".color-selector").on("input", function() {
            var get_index = Number(sessionStorage.getItem("get_color_index"));
            var element = document.getElementsByClassName("target")[get_index];
            var color = this.value;
            element.style.color = color;
        });
        $(".font-size").on("input", function() {
            var get_index = Number(sessionStorage.getItem("get_color_index"));
            var element = document.getElementsByClassName("target")[get_index];
            var size = this.value;
            element.style.fontSize = size + "%";
        });
    });
    //title image
    $(document).ready(function() {
        $("#title-image").on("change", function() {
            var file = this.files[0];
            if (file.size <= 200000) {
                var url = URL.createObjectURL(file);
                var image = new Image();
                image.src = url;
                image.onload = function() {

                    var original_width = image.width;
                    var original_height = image.height;
                    if (original_height == 978 && original_width == 1920) {
                        image.style.width = "100%";
                        image.style.position = "absolute";
                        image.style.top = "0";
                        image.style.left = "0";

                        $(".showcase-preview").append(image);
                    } else {
                        alert("Please upload image of width 1920px and height 978px");
                    }
                }
            } else {
                alert("Upload image less than 200kb");
            }
        });
    });

    //textarea max length
    $(document).ready(function() {
        $("#title-text").on("input", function() {
            var length = this.value.length;
            $(".title-limit").html(length);
            $(".showcase-title").html(this.value);
        });

        $("#subtitle-text").on("input", function() {
            var length = this.value.length;
            $(".subtitle-limit").html(length);
            $(".showcase-subtitle").html(this.value);
        });

    });

    //add showcase
    $(document).ready(function() {
        $(".header-showcase-form").submit(function(e) {
            e.preventDefault();
            var title = document.querySelector(".showcase-title");
            var subtitle = document.querySelector(".showcase-subtitle");
            var file = document.querySelector("#title-image").files[0];
            var title_font = "";
            var title_color = "";
            var subtitle_font = "";
            var subtitle_color = "";
            //title
            if (title.style.fontSize == "") {
                title_font = "300%";
            } else {
                title_font = title.style.fontSize;
            }
            if (title.style.color == "") {
                title_color = "black";
            } else {
                title_color = title.style.color;
            }
            //subtitle
            if (subtitle.style.fontSize == "") {
                subtitle_font = "200%";
            } else {
                subtitle_font = subtitle.style.fontSize;
            }
            if (subtitle.style.color == "") {
                subtitle_color = "black";
            } else {
                subtitle_color = subtitle.style.color;
            }

            var flex_box = document.querySelector(".showcase-preview");
            var h_align = "";
            var v_align = "";
            if (flex_box.style.justifyContent == "") {
                h_align = "flex-start";
            } else {
                h_align = flex_box.style.justifyContent;
            }

            if (flex_box.style.alignItems == "") {
                v_align = "flex-start";
            } else {
                v_align = flex_box.style.alignItems;
            }

            var css_data = {
                title_font: title_font,
                title_color: title_color,
                subtitle_font: subtitle_font,
                subtitle_color: subtitle_color,
                h_align: h_align,
                v_align: v_align,
                title_text: title.innerHTML,
                subtitle_text: subtitle.innerHTML,
                button: $(".title-button").html().trim(),
                options: $("#edit-title").val().trim()
            }
            var formdata = new FormData();
            formdata.append("file_data", file);
            formdata.append("css_data", JSON.stringify(css_data));
            $.ajax({
                type: "POST",
                url: "php/header_showcase.php",
                data: formdata,
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {
                    alert(response);
                }
            });

        });
    });


    //alignment
    $(document).ready(function() {
        $(".alignment").each(function() {
            $(this).click(function() {
                var align_position = $(this).attr("align-position");
                var align_value = $(this).attr("align-value");
                if (align_position == "h") {
                    $(".showcase-preview").css({
                        justifyContent: align_value
                    });
                } else if (align_position == "v") {
                    $(".showcase-preview").css({
                        alignItems: align_value
                    });
                }
            });
        });
    });

    //add button
    $(document).ready(function() {
        $(".add-btn").click(function() {
            var button = document.createElement("BUTTON");
            button.className = "btn mr-2 title-btn shadow-sm";
            button.type = "button";
            var a = document.createElement("A");
            a.href = $(".btn-url").val();
            button.style.color = $(".btn-bgcolor").val();
            a.innerHTML = $(".btn-name").val();
            button.style.background = $(".btn-bgcolor").val();
            a.style.fontSize = $(".btn-size").val();
            a.style.color = $(".btn-textcolor").val();
            a.style.textDecoration = "none";
            button.append(a);

            var title_button = document.querySelector(".title-button");
            var title_child = title_button.getElementsByTagName("BUTTON");
            var button_length = title_child.length;
            if (button_length == 0 || button_length == 1) {
                $(".title-button").append(button);
            } else {
                alert("Only two button are allowed");
            }
        });
    });

    //real-preview
    $(document).ready(function() {
        $(".real-preview-btn").click(function(e) {
            e.preventDefault();
            var title_image = document.querySelector("#title-image").files[0];
            var formdata_add_preview = new FormData();
            formdata_add_preview.append("photo", title_image);
            var flex_box = document.querySelector(".showcase-preview");
            var h_align = "";
            var v_align = "";
            if (flex_box.style.justifyContent == "") {
                h_align = "flex-start";
            } else {
                h_align = flex_box.style.justifyContent;
            }

            if (flex_box.style.alignItems == "") {
                v_align = "flex-start";
            } else {
                v_align = flex_box.style.alignItems;
            }
            var array = {
                title_box: $(".title-box").html().trim(),
                h_align: h_align,
                v_align: v_align
            };

            formdata_add_preview.append("data_123", JSON.stringify(array));

            $.ajax({
                type: "POST",
                url: "php/preview.php",
                data: formdata_add_preview,
                processData: false,
                contentType: false,
                cache: false,
                success: function(response_ONE) {
                    var page = window.open("about:blank");
                    page.document.open();
                    page.document.write(response_ONE);
                    page.document.close();

                }
            });
        });
    });
    //edit title
    $(document).ready(function() {
        var showcase_preview = $(".showcase-preview").html();
        $("#edit-title").on("change", function() {
            if ($(this).val() != "Choose Title") {
                var id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "php/edit_title.php",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $("#title-image").removeAttr("required");
                        var edit_title_id = $("#edit-title").val();
                        $(".add-showcase").html("Save Edit");
                        $(".add-showcase").removeClass("bg-primary");
                        $(".add-showcase").addClass("bg-danger");
                        $(".delete-title").removeClass("d-none");
                        $(".delete-title").click(function() {
                            $.ajax({
                                type: "POST",
                                url: "php/delete_title.php",
                                data: {
                                    id: $("#edit-title").val()
                                },
                                success: function(response) {
                                    if (response.trim() == "success") {
                                        $(".add-showcase").html("Add Showcase");
                                        $(".add-showcase").removeClass("bg-danger");
                                        $(".add-showcase").addClass("bg-primary");
                                        $(".header-showcase-form").trigger('reset');
                                        $(".showcase-preview").html(showcase_preview);
                                        $(".delete-title").addClass("d-none");
                                        $("#title-text").html("");
                                        $("#subtitle-text").html("");
                                        var op = $("#edit-title option");
                                        op[0].selected = "selected";
                                        var i;
                                        for (i = 0; i < op.length; i++) {
                                            if (op[i].value == edit_title_id) {
                                                op[i].remove();
                                            }
                                        }
                                    } else {
                                        alert(response);
                                    }
                                }
                            });
                        });
                        var all_data = JSON.parse(response);
                        var image = document.createElement("IMG");
                        image.src = all_data[0];
                        image.style.width = "100%";
                        image.style.position = "absolute";
                        image.style.top = "0";
                        image.style.left = "0";

                        $(".showcase-preview").append(image);
                        $(".showcase-title").html(all_data[3]);
                        $(".showcase-title").css({
                            fontSize: all_data[1],
                            color: all_data[2]
                        });
                        $("#title-text").html(all_data[3]);
                        $(".showcase-subtitle").html(all_data[6]);
                        $(".showcase-subtitle").css({
                            fontSize: all_data[4],
                            color: all_data[5]
                        });
                        $("#subtitle-text").html(all_data[6]);
                        var button = all_data[9];
                        $(".title-button").html(button);
                        //edit btn
                        $(".title-btn").each(function() {
                            $(this).click(function(e) {

                                e.preventDefault();
                                $(".delete-btn").removeClass("d-none");
                                sessionStorage.setItem("btn_index", $(this).index());
                                var url = $(this).children().attr("href");
                                $(".btn-url").val(url);
                                var name = $(this).children().html();
                                $(".btn-name").val(name);
                                var color = $(this).css("backgroundColor").replace("rgb(", "").replace(")", "");
                                var rgb = color.split(",");
                                var i;
                                var color_code = "";
                                for (i = 0; i < rgb.length; i++) {
                                    var hex_code = Number(rgb[i]).toString(16);
                                    color_code += hex_code.length == 1 ? "0" + hex_code : hex_code;
                                }
                                $(".btn-bgcolor").val("#" + color_code);

                                var text_color = $(this).children().css("color").replace("rgb(", "").replace(")", "");
                                var text_rgb = text_color.split(",");
                                var text_color_code = "";
                                for (i = 0; i < text_rgb.length; i++) {
                                    var text_hex_code = Number(text_rgb[i]).toString(16);
                                    text_color_code += text_hex_code.length == 1 ? "0" + text_hex_code : text_hex_code;
                                }
                                $(".btn-textcolor").val("#" + text_color_code);

                                var btn_size = $(this).children().css('fontSize');
                                for (i = 0; i < $(".btn-size").children().length; i++) {
                                    var option = $(".btn-size").children();
                                    if (option[i].value == btn_size) {
                                        option[i].selected = "selected";
                                    }
                                }
                            });
                        });

                        $(".btn-name").on("input", function() {
                            var index = Number(sessionStorage.getItem("btn_index"));
                            var selected_btn = document.getElementsByClassName('title-btn')[index];
                            selected_btn.getElementsByTagName("A")[0].innerHTML = this.value;
                        });

                        $(".btn-url").on("input", function() {
                            var index = Number(sessionStorage.getItem("btn_index"));
                            var selected_btn = document.getElementsByClassName('title-btn')[index];
                            selected_btn.getElementsByTagName("A")[0].innerHTML = this.value;
                        });

                        $(".btn-bgcolor").on("input", function() {
                            var index = Number(sessionStorage.getItem("btn_index"));
                            var selected_btn = document.getElementsByClassName('title-btn')[index];
                            selected_btn.style.backgroundColor = this.value;
                        });

                        $(".btn-textcolor").on("input", function() {
                            var index = Number(sessionStorage.getItem("btn_index"));
                            var selected_btn = document.getElementsByClassName('title-btn')[index];
                            selected_btn.getElementsByTagName("A")[0].style.color = this.value;
                        });

                        $(".btn-size").on("change", function() {
                            var index = Number(sessionStorage.getItem("btn_index"));
                            var selected_btn = document.getElementsByClassName('title-btn')[index];
                            selected_btn.getElementsByTagName("A")[0].style.fontSize = this.value;
                        });
                        //delete-btn
                        $(".delete-btn").on("click", function() {
                            var index = Number(sessionStorage.getItem("btn_index"));
                            var selected_btn = document.getElementsByClassName('title-btn')[index];
                            selected_btn.remove();
                            $(".btn-url,.btn-name").val("");
                            $(".btn-bgcolor,.btn-textcolor").val("#000000");
                            var op = $(".btn-size option");
                            op[0].selected = "selected";
                            $(".delete-btn").addClass("d-none");
                            $("#title-text").html("");
                            $("#subtitle-text").html("");
                        });
                    }
                });
            } else {
                $(".add-showcase").html("Add Showcase");
                $(".add-showcase").removeClass("bg-danger");
                $(".add-showcase").addClass("bg-primary");
                $(".header-showcase-form").trigger('reset');
                $(".showcase-preview").html(showcase_preview);
                $(".delete-title").addClass("d-none");
                $("#title-text").html("");
                $("#subtitle-text").html("");
                $("#title-image").attr("required");
            }
        });
    });
}
//category showcase
function category_showcase() {
    $(document).ready(function() {
        $(".upload-icon").each(function() {
            $(this).on("change", function() {
                var upload_icon = this;
                var dummy_pic = upload_icon.parentElement.parentElement.parentElement.getElementsByTagName('img')[0];
                var input = upload_icon.parentElement.parentElement.getElementsByTagName("INPUT")[1];
                var set_btn = upload_icon.parentElement.parentElement.getElementsByClassName("set-btn")[0];
                var dummy_pic_width = dummy_pic.naturalWidth;
                var dummy_pic_height = dummy_pic.naturalHeight;
                var file = upload_icon.files[0];
                var url = URL.createObjectURL(file);
                var image = new Image();
                image.src = url;
                var uploaded = "";
                image.onload = function() {
                    var upload_width = image.width;
                    var upload_height = image.height;
                    if (dummy_pic_width == upload_width && dummy_pic_height == upload_height) {
                        input.oninput = function() {
                            if (this.value.length >= 1) {
                                set_btn.disabled = false;
                                set_btn.onclick = function() {
                                    var formdata = new FormData();
                                    formdata.append("photo", file);
                                    formdata.append("text", input.value);
                                    formdata.append("direction", $(set_btn).attr("img-dir"));
                                    $.ajax({
                                        type: "POST",
                                        url: "php/category_showcase.php",
                                        data: formdata,
                                        processData: false,
                                        cache: false,
                                        contentType: false,
                                        beforeSend: function() {
                                            $(set_btn).html("Please Wait...");
                                        },
                                        success: function(response) {
                                            if (response.trim() == "success") {
                                                $(set_btn).html("SET");
                                                dummy_pic.src = url;
                                                $(upload_icon.parentElement.parentElement).addClass("d-none");
                                                dummy_pic.ondblclick = function() {

                                                    $(upload_icon.parentElement.parentElement).removeClass("d-none");
                                                }
                                            }
                                        }
                                    });
                                }
                            } else {
                                set_btn.disabled = true;
                            }
                        }
                    } else {
                        alert("Please upload image of :" + dummy_pic_width + "/" + dummy_pic_height);
                    }
                }
            });
        });
    });

    $(document).ready(function() {
        var img = $("img");
        var i;
        for (i = 0; i < img.length; i++) {
            if (img[i].src.indexOf("base64") != -1) {
                var set_btn = img[i].parentElement.getElementsByClassName("set-btn")[0];
                set_btn.disabled = false;
                $(".set-btn").each(function() {
                    $(this).click(function() {
                        set_btn = this;
                        var input = this.parentElement.getElementsByTagName("INPUT");
                        var file = input[0].files[0];
                        var text = input[1].value;
                        var dummy_pic = this.parentElement.parentElement.getElementsByTagName("img")[0];
                        var url = dummy_pic.src;
                        if (input[0].value != "") {
                            url = URL.createObjectURL(input[0].files[0]);
                        }
                        var formdata = new FormData();
                        formdata.append("photo", file);
                        formdata.append("text", text);
                        formdata.append("direction", $(set_btn).attr("img-dir"));
                        $.ajax({
                            type: "POST",
                            url: "php/category_showcase.php",
                            data: formdata,
                            processData: false,
                            contentType: false,
                            cache: false,
                            beforeSend: function() {
                                set_btn.innerHtml = "Please Wait...";
                            },
                            success: function(response) {
                                if (response.trim() == "success") {
                                    set_btn.innerHtml = "SET";
                                    dummy_pic.src = url;
                                    $(set_btn.parentElement).addClass("d-none");
                                    dummy_pic.ondblclick = function() {

                                        $(set_btn.parentElement).removeClass("d-none");
                                    }
                                }
                            }
                        });
                    });
                });

            }
        }
    });
}

function delivery() {
    //get state with the help of country
    $(document).ready(function() {
        $(".country").on("change", function() {
            var option = $(".country option");
            $(".state").html("");
            // alert($(".country").val());
            var i, j;
            for (i = 0; i < option.length; i++) {
                if (option[i].value == $(".country").val()) {
                    var country_id = option[i].getAttribute("country-id");
                    $.ajax({
                        type: "POST",
                        url: "php/get_states.php",
                        data: {
                            country_id: country_id
                        },
                        success: function(response) {
                            var state = JSON.parse(response.trim());
                            for (j = 0; j < state.length; j++) {
                                var option_state = "<option state-id='" + state[j].id + "'>" + state[j].name + "</option>";
                                $(".state").append(option_state);
                            }
                        }
                    });
                }
            }
        });
    });

    //get city with the help of state
    $(document).ready(function() {
        $(".state").on("change", function() {
            var option = $(".state option");
            $(".city").html("");
            // alert($(".country").val());
            var i, j;
            for (i = 0; i < option.length; i++) {
                if (option[i].value == $(".state").val()) {
                    var state_id = option[i].getAttribute("state-id");
                    $.ajax({
                        type: "POST",
                        url: "php/get_city.php",
                        data: {
                            state_id: state_id
                        },
                        success: function(response) {
                            var city = JSON.parse(response.trim());
                            for (j = 0; j < city.length; j++) {
                                var option_city = "<option>" + city[j].name + "</option>";
                                $(".city").append(option_city);
                            }
                        }
                    });
                }
            }
        });
    });

    $(document).ready(function() {
        $(".city").on("change", function() {
            var city_name = $(this).val();
            var state_name = $(".state").val();
            $.ajax({
                type: "GET",
                url: "https://api.postalpincode.in/postoffice/" + city_name,
                success: function(response) {
                    var length = response[0].PostOffice.length - 1;

                    var i;
                    var store;
                    for (i = 0; i <= length; i++) {
                        if (response[0].PostOffice[i].Name == city_name &&
                            response[0].PostOffice[i].Circle == state_name) {
                            store = i;
                        }
                    }
                    $(".pincode").val(response[0].PostOffice[store].Pincode);
                }
            });
        });
    });
    //set area
    $(document).ready(function() {
        $(".set-area-form").submit(function(e) {
            e.preventDefault();
            // $(".pincode").removeAttr("disabled");
            $.ajax({
                type: "POST",
                url: "php/delivery_details.php",
                data: new FormData(this),
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {
                    alert(response);
                }
            });
        });
    });
}