$(window).on("load", function () {
    $(".page-loader").fadeOut("slow");
}),
    $(document).on("submit", function () {
        $(".page-loader").show();
    }),
    $("#cost").on("change paste keyup", function () {
        var a = parseFloat($("#cost").val()),
            t = parseFloat($("#discount").val()),
            e = a - a * (t /= 100);
        $("#price").val(e);
    }),
    $("#discount").on("change paste keyup", function () {
        var a = parseFloat($("#cost").val()),
            t = parseFloat($("#discount").val()),
            e = a - a * (t /= 100);
        $("#price").val(e);
    }),
    $("#standard_cost").on("change paste keyup", function () {
        var a = parseFloat($("#standard_cost").val()),
            t = parseFloat($("#standard_discount").val()),
            e = a - a * (t /= 100);
        $("#standard_price").val(e);
    }),
    $("#standard_discount").on("change paste keyup", function () {
        var a = parseFloat($("#standard_cost").val()),
            t = parseFloat($("#standard_discount").val()),
            e = a - a * (t /= 100);
        $("#standard_price").val(e);
    }),
    $("#excellent_cost").on("change paste keyup", function () {
        var a = parseFloat($("#excellent_cost").val()),
            t = parseFloat($("#excellent_discount").val()),
            e = a - a * (t /= 100);
        $("#excellent_price").val(e);
    }),
    $("#excellent_discount").on("change paste keyup", function () {
        var a = parseFloat($("#excellent_cost").val()),
            t = parseFloat($("#excellent_discount").val()),
            e = a - a * (t /= 100);
        $("#excellent_price").val(e);
    }),
    $("#order_ship").on("change paste keyup", function () {
        let a = $(this).val(),
            t = $("#order_price").val(),
            e = parseFloat(a) + parseFloat(t);
        $("#order_total").val(e);
    });
var _token = $('meta[name="csrf-token"]').attr("content");
function readall() {
    $(".page-loader").show(),
        $.ajax({
            url: "/admin/allread",
            type: "POST",
            dataType: "json",
            data: { _token: _token },
        })
            .done(function () {
                $(".page-loader").hide(), $(".n-single.new").removeClass("new");
            })
            .fail(function () {
                $(".page-loader").hide();
                let a = $("body");
                (data =
                    "<div class='notification error' style='top:55px'><p><i class='mdi mdi-alert-octagon'></i>Error,Something wrong</p></div>"),
                    a.append(data),
                    $(".notification").fadeIn(),
                    $(".notification")
                        .delay(3e3)
                        .fadeOut(300, function () {
                            $(this).remove();
                        });
            });
}
function reader(a) {
    let t = $(a).data("id"),
        e = $(a).data("orderid");
    $(".page-loader").show(),
        $.ajax({
            url: "/admin/read",
            type: "POST",
            dataType: "json",
            data: { _token: _token, id: t },
        })
            .done(function () {
                window.location.href =
                    window.location.protocol +
                    "//" +
                    location.host +
                    "/admin/order/" +
                    e;
            })
            .fail(function () {
                $(".page-loader").hide();
                let a = $("body");
                (data =
                    "<div class='notification error' style='top:55px'><p><i class='mdi mdi-alert-octagon'></i>Error,Something wrong</p></div>"),
                    a.append(data),
                    $(".notification").fadeIn(),
                    $(".notification")
                        .delay(3e3)
                        .fadeOut(300, function () {
                            $(this).remove();
                        });
            });
}
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    var a = $('meta[name="csrf-token"]').attr("content");
    function t() {
        $.ajax({
            url: "/admin/push-notification",
            type: "GET",
            dataType: "html",
            data: { _token: a },
        })
            .done(function (a) {
                $("#noti-drop").append(a);
            })
            .fail(function () {
                $("#noti-drop").append("<i>no notifications</i>");
            });
    }
    $(".notification").animate({ top: "55px" }),
        $(".notification").delay(6e3).animate({ top: "0" }),
        $("#notificationDropdown").click(function () {
            $("#noti-drop").toggle(),
                0 == $("#noti-drop a").hasClass("new") &&
                    $("#notificationDropdown span").remove();
        }),
        t(),
        setInterval(function () {
            $("#noti-drop").empty(), t();
        }, 15e3),
        $(".nav-search input").keyup(function () {
            let t = $(".nav-search input").val();
            if ("" == t)
                return $(".nav-search .block .search-list").html(
                    '<li class="empty">not found</li>'
                );
            $.ajax({
                url: "/admin/search",
                type: "POST",
                dataType: "html",
                data: { _token: a, value: t },
            })
                .done(function (a) {
                    $(".nav-search .block .search-list").html(a);
                })
                .fail(function () {
                    $(".nav-search .block .search-list").html(
                        '<li class="empty">not found</li>'
                    );
                });
        }),
        $("#auto").click(function () {
            let t;
            (t = $(this).hasClass("checked") ? "manual" : "auto"),
                $(".page-loader").show(),
                $.ajax({
                    url: "/admin/auto",
                    type: "POST",
                    dataType: "json",
                    data: { _token: a, value: t },
                })
                    .done(function (a) {
                        if (t == "manual") {
                            $("#auto").removeClass("checked");
                        } else {
                            $("#auto").addClass("checked");
                            $.ajax({
                                url: "/admin/auto/order-notification",
                                type: "GET",
                            });
                        }
                        $(".page-loader").hide(),
                            $("body").append(
                                "<div class='notification success' style='top:55px'><p><i class='mdi mdi-alert-octagon'></i>success,Changed</p></div>"
                            ),
                            $(".notification").fadeIn(),
                            $(".notification")
                                .delay(3e3)
                                .fadeOut(300, function () {
                                    $(this).remove();
                                });
                    })
                    .fail(function () {
                        let a = $("body");
                        (data =
                            "<div class='notification error' style='top:55px'><p><i class='mdi mdi-alert-octagon'></i>Error,Something wrong</p></div>"),
                            a.append(data),
                            $(".notification").fadeIn(),
                            $(".notification")
                                .delay(3e3)
                                .fadeOut(300, function () {
                                    $(this).remove();
                                });
                    });
        }),
        $(".unit").on("change", function (a) {
            let t = this.value,
                e = $(".stock");
            if ("kg" == t) e.attr("step", 0.1);
            else
                for (let a = 0; a < e.length; a++) {
                    let t = $(e[a]).val();
                    $(e[a]).val(Math.round(t)), $(e[a]).attr("step", 1);
                }
        }),
        $("#pCount").on("change", function (a) {
            let t = this.value,
                e = ($("#c1"), $("#c2")),
                n = $("#c3");
            2 == t
                ? (e.attr("hidden", !1),
                  $('#c2 select[name="product_id2"] option:eq(0)').prop(
                      "selected",
                      !0
                  ),
                  $('#c2 select[name="type2"] option:eq(0)').prop(
                      "selected",
                      !0
                  ),
                  n.attr("hidden", !0))
                : (e.attr("hidden", !1),
                  n.attr("hidden", !1),
                  $('#c3 select[name="product_id2"] option:eq(0)').prop(
                      "selected",
                      !0
                  ),
                  $('#c3 select[name="type2"] option:eq(0)').prop(
                      "selected",
                      !0
                  ));
        });
});
$("#profileDropdown").click(function () {
    $(this).next(".dropdown-menu").toggle();
});
$(window).click(function () {
    $(".dropdown-menu").hide();
});
function notiPermission() {
    document.addEventListener("DOMContentLoaded", function () {
        if (Notification.permission !== "granted") {
            Notification.requestPermission();
        }
    });
}
notiPermission();

function invoice(m) {
    $(".page-loader").show();
    let token = $('meta[name="csrf-token"]').attr("content");
    let total_price = m.find(".total_price").val();
    let oid = m.find(".OrderID").val();
    let total_qty = m.find(".total_qty").val();
    let detailId = [];
    m.find("input[type=checkbox]:checked").each(function () {
        detailId.push($(this).val());
    });
    console.clear();
    console.log('order_id='+oid);
    console.log('total_price='+total_price);
    console.log('total_qty='+total_qty);
    $.ajax({
        url: "/admin/invoice/",
        type: "get",
        dataType: "html",
        data: { _token: token,order_id: oid,total_price: total_price,total_qty: total_qty,detailId: detailId },
    })
        .done(function (data) {
            $(".page-loader").hide();
            $("#printf").html(data);
            let divToPrint=document.getElementById('printf');
            let newWin=window.open('','Print-Window');
            newWin.document.open();
            newWin.document.write('<html><body class="ticket-body" onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
            newWin.document.close();
            setTimeout(function(){newWin.close();},10);
        })
        .fail(function () {
            $(".page-loader").hide();
            let a = $("body");
            (data =
                "<div class='notification error' style='top:55px'><p><i class='mdi mdi-alert-octagon'></i>Error,Something wrong</p></div>"),
                a.append(data),
                $(".notification").fadeIn(),
                $(".notification")
                    .delay(3e3)
                    .fadeOut(300, function () {
                        $(this).remove();
                    });
        });
};

function purchase(date) {
    $(".page-loader").show();
    console.clear();
    console.log('date='+date);
    $.ajax({
        url: "/admin/purchase/bill/" + date,
        type: "get",
        dataType: "html",
    })
        .done(function (data) {
            $(".page-loader").hide();
            $("#printf").html(data);
            let divToPrint=document.getElementById('printf');
            let newWin=window.open('','Print-Window');
            newWin.document.open();
            newWin.document.write('<html><body class="ticket-body" onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
            newWin.document.close();
            setTimeout(function(){newWin.close();},10);
        })
        .fail(function () {
            $(".page-loader").hide();
            let a = $("body");
            (data =
                "<div class='notification error' style='top:55px'><p><i class='mdi mdi-alert-octagon'></i>Error,Something wrong</p></div>"),
                a.append(data),
                $(".notification").fadeIn(),
                $(".notification")
                    .delay(3e3)
                    .fadeOut(300, function () {
                        $(this).remove();
                    });
        });
}

$("body").on( "click", ".print-check", function (event ) {
    let total_qty;
    let total_price;
    let original_qty = $(this).parent().closest(".modal-content").find(".total_qty").val();
    let single_qty = $(this).parent().closest(".tr").find(".qty").val();
    let original_price = $(this).parent().closest(".modal-content").find(".total_price").val();
    let single_price = $(this).parent().closest(".tr").find(".price").val();
    if ($(this).prop("checked") == true) {
        total_qty = parseFloat(original_qty) + parseFloat(single_qty);
        $(this).parent().closest(".modal-content").find(".total_qty").val(total_qty.toFixed(2));
        total_price = parseFloat(original_price) + parseFloat(single_price);
        $(this).parent().closest(".modal-content").find(".total_price").val(total_price.toFixed(2));
    } else {
        total_qty = original_qty - single_qty;
        $(this).parent().closest(".modal-content").find(".total_qty").val(total_qty.toFixed(2));
        total_price = original_price - single_price;
        $(this).parent().closest(".modal-content").find(".total_price").val(total_price.toFixed(2));
    }
});

function printOrder(m) {
    $(".page-loader").show();
    $("#printOrder").modal('hide');
    let token = $('meta[name="csrf-token"]').attr("content");
    let orderId = [];
    m.find("input[type=checkbox]:checked").each(function () {
        orderId.push($(this).val());
    });
    console.clear();
    console.log('orderId='+JSON.stringify(orderId));
    $.ajax({
        url: "/admin/print/order",
        type: "post",
        dataType: "html",
        data: { _token: token,orderId: orderId },
    })
        .done(function (data) {
            $(".page-loader").hide();
            var w = window.open('about:blank');
            w.document.open();
            w.document.write(data);
            w.document.close();
        })
        .fail(function () {
            $(".page-loader").hide();
            let a = $("body");
            (data =
                "<div class='notification error' style='top:55px'><p><i class='mdi mdi-alert-octagon'></i>Error,Something wrong</p></div>"),
                a.append(data),
                $(".notification").fadeIn(),
                $(".notification")
                    .delay(3e3)
                    .fadeOut(300, function () {
                        $(this).remove();
                    });
        });
};
