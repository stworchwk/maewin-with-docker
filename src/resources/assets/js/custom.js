"use strict";

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

$(function () {
    $('[data-toggle="popover"]').popover();
    $(".popover-dismiss").popover({
        trigger: "focus"
    });
});

var custom = {
    lunchModalAndGetPage: function lunchModalAndGetPage(url, title) {
        var modalColor = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;

        $.ajax({
            method: "get",
            url: url,
            beforeSend: function beforeSend() {
                swal({
                    title: "รอสักครู่!",
                    timer: 0,
                    allowOutsideClick: false,
                    onOpen: function onOpen() {
                        swal.showLoading();
                    }
                });
            }
        }).done(function (data) {
            swal.close();
            $("#myModalLabel").html(title);
            if (title != "" || title != undefined) {
                $("#showDataContentModal").html(data);
            }
            $("#myModalView").modal("show");
            if (modalColor !== null) {
                $("#myModalView").children(".modal-dialog").attr("class", "modal-dialog modal-lg " + modalColor);
            }
        }).fail(function () {
            swal.close();
            alert.message("เกิดข้อผิดพลาดไม่สามารถเชื่อมต่อเครือข่ายได้ กรุณาลองอีกครั้ง", "warning");
        });
    },
    lunchModalAndGetPageMobile: function lunchModalAndGetPageMobile(url, title, width, height) {
        var modalColor = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
        $("#modalMobileWidth").css("width", width);
        $("#modalMobileHeight").css("height", height);

        $.ajax({
            method: "get",
            url: url,
            beforeSend: function beforeSend() {
                swal({
                    title: "รอสักครู่!",
                    timer: 0,
                    allowOutsideClick: false,
                    onOpen: function onOpen() {
                        swal.showLoading();
                    }
                });
            }
        }).done(function (data) {
            swal.close();
            $("#myMobileModalLabel").html(title);
            if (title != "" || title != undefined) {
                $("#showDataContentModalMobile").html(data);
            }
            $("#myMobileModalView").modal("show");
            if (modalColor !== null) {
                $("#myMobileModalView").children(".modal-dialog").attr("class", "modal-dialog modal-lg " + modalColor);
            }
            $('#showDataContentModalMobile img').addClass('img-fluid');
        }).fail(function () {
            swal.close();
            alert.message("เกิดข้อผิดพลาดไม่สามารถเชื่อมต่อเครือข่ายได้ กรุณาลองอีกครั้ง", "warning");
        });
    }
};

var alert = {
    message: function message(_message, type) {
        swal({
            position: "top-right",
            type: type,
            title: _message,
            showConfirmButton: false
        });
    },
    close: function close(url) {
        swal({
            title: "คุณแน่ใจหรือ ?",
            text: "คุณแน่ใจหรือไม่ว่าจะทำการลบรายการนี้ การกระทำนี้จะไม่สามารถกู้กลับมาได้อีก",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ใช่, ทำเลย!",
            cancelButtonText: "ยกเลิก"
        }).then(function (result) {
            $('#btnClose').addClass('disabled');
            if (result.value) {
                window.location.href = url;
            }
        });
    },
    restore: function restore(url) {
        swal({
            title: "คุณแน่ใจหรือ ?",
            text: "คุณแน่ใจหรือไม่ว่าจะทำการคืนค่าข้อมูลเดิม การกระทำนี้อาจมีผลกระทบกับข้อมูลอื่น",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ใช่, ทำเลย!",
            cancelButtonText: "ยกเลิก"
        }).then(function (result) {
            if (result.value) {
                $('#btnRestore').addClass('disabled');
                window.location.href = url;
            }
        });
    },
    destroy: function destroy(url) {
        swal({
            title: "คุณแน่ใจหรือ ?",
            text: "คุณแน่ใจหรือไม่ว่าจะทำการลบข้อมูล การกระทำนี้จะไม่สามารถกู้กลับมาได้อีก",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ใช่, ทำเลย!",
            cancelButtonText: "ยกเลิก"
        }).then(function (result) {
            if (result.value) {
                $('#btnDestroy').addClass('disabled');
                window.location.href = url;
            }
        });
    },
    changeActive: function changeActive(url, active) {
        swal({
            title: "คุณแน่ใจหรือ ?",
            text: Number(active) === 0 ? "คุณแน่ใจหรือไม่ว่าจะทำการเปิดการใช้งาน" : "คุณแน่ใจหรือไม่ว่าจะทำการระงับการใช้งาน",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ใช่, ทำเลย!",
            cancelButtonText: "ยกเลิก"
        }).then(function (result) {
            if (result.value) {
                $('#btnChangeActive').addClass('disabled');
                window.location.href = url;
            }
        });
    }
};

var action = {
    plan: function plan(message, path, error_message, success_path, success_message) {
        swal({
            title: "คุณแน่ใจหรือ ?",
            text: message,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ใช่, ทำเลย!",
            cancelButtonText: "ยกเลิก"
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: path,
                    beforeSend: function beforeSend() {
                        swal({
                            title: "รอสักครู่!",
                            timer: 0,
                            allowOutsideClick: false,
                            onOpen: function onOpen() {
                                swal.showLoading();
                            }
                        });
                    }
                }).done(function (data) {
                    if (data.status === "success") {
                        $.ajax({
                            method: "get",
                            url: success_path + data.id
                        }).done(function (data) {
                            swal.close();
                            $("#myModalLabel").html("แบบแปลน");
                            $("#showDataContentModal").html(data);
                            $("#myModalView").modal("show");
                            swal({
                                position: "top-right",
                                type: "success",
                                title: success_message,
                                showConfirmButton: false
                            });
                        }).fail(function () {
                            swal.close();
                            alert.message("เกิดข้อผิดพลาดไม่สามารถเชื่อมต่อเครือข่ายได้ กรุณาลองอีกครั้ง", "warning");
                        });
                    } else {
                        swal({
                            position: "top-right",
                            type: "error",
                            title: error_message,
                            showConfirmButton: false
                        });
                    }
                }).fail(function () {
                    alert.message("เกิดข้อผิดพลาดไม่สามารถเชื่อมต่อเครือข่ายได้ กรุณาลองอีกครั้ง", "warning");
                });
            }
        });
    }
};

$(document).on("mouseover", '.mouse-over-event', function (e) {
    $('.img-viewer').attr('src', e.target.attributes.getNamedItem('src').value).show(200);
}).on("mouseleave", '.mouse-over-event', function (e) {
    $('.img-viewer').attr('src', null).hide(200);
});