function addCart(t, o, e,d) {
    $(".pre-loader").show();
    let i = $('meta[name="csrf-token"]').attr("content");
    $.ajax({
        type: "post",
        url: "/customer/cart/add/ajax",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf=token"]').attr("content"),
        },
        data: { _token: i, product_id: t, qty: o, price_type: e,day:d },
        success: function (t) {
            if (($(".pre-loader").hide(), t.success)) {
                let t =
                    "<div class='notification success' style='display:none'><p><i class='mdi mdi-alert-octagon'></i>success,Added to carts</p></div>";
                $("body").append(t),
                    $(".notification").fadeIn(),
                    $(".notification")
                        .delay(3e3)
                        .fadeOut(300, function () {
                            $(this).remove();
                        });
            }
            if (t.update) {
                let t =
                    "<div class='notification success' style='display:none'><p><i class='mdi mdi-alert-octagon'></i>Success, Updated to carts</p></div>";
                $("body").append(t),
                    $(".notification").fadeIn(),
                    $(".notification")
                        .delay(3e3)
                        .fadeOut(300, function () {
                            $(this).remove();
                        });
            }
            if (t.ofs) {
                let t =
                    "<div class='notification error' style='display:none'><p><i class='mdi mdi-alert-octagon'></i>Sorry product out of stock</p></div>";
                $("body").append(t),
                    $(".notification").fadeIn(),
                    $(".notification")
                        .delay(3e3)
                        .fadeOut(300, function () {
                            $(this).remove();
                        });
            }
            if (t.dp) {
                if($('#daySelect').val() == 'today'){dp = 'tomorrow'}else{dp = 'today'}
                let t =
                    "<div class='notification error' style='display:none'><p><i class='mdi mdi-alert-octagon'></i>Cart has "+dp+" product, Please Clear and continue!</p></div>";
                $("body").append(t),
                    $(".notification").fadeIn(),
                    $(".notification")
                        .delay(3e3)
                        .fadeOut(300, function () {
                            $(this).remove();
                        });
            }
        },
        error: function () {
            $(".pre-loader").hide();
            $("body").append(
                "<div class='notification error' style='display:none'><p><i class='mdi mdi-alert-octagon'></i>Unauthorized user!</p></div>"
            ),
                $(".notification").fadeIn(),
                $(".notification")
                    .delay(3e3)
                    .fadeOut(300, function () {
                        $(this).remove();
                    });
        },
    });
}
function addCombo(t, o,d) {
    $(".pre-loader").show();
    let e = $('meta[name="csrf-token"]').attr("content");
    $.ajax({
        type: "post",
        url: "/customer/cart/add/combo-ajax",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf=token"]').attr("content"),
        },
        data: { _token: e, combo_id: t, qty: o,day:d },
        success: function (t) {
            if (($(".pre-loader").hide(), t.success)) {
                let t =
                    "<div class='notification success' style='display:none'><p><i class='mdi mdi-alert-octagon'></i>success,Added to carts</p></div>";
                $("body").append(t),
                    $(".notification").fadeIn(),
                    $(".notification")
                        .delay(3e3)
                        .fadeOut(300, function () {
                            $(this).remove();
                        });
            }
            if (t.ofs) {
                let t =
                    "<div class='notification error' style='display:none'><p><i class='mdi mdi-alert-octagon'></i>Combo out of stock</p></div>";
                $("body").append(t),
                    $(".notification").fadeIn(),
                    $(".notification")
                        .delay(3e3)
                        .fadeOut(300, function () {
                            $(this).remove();
                        });
            }
            if (t.exists) {
                let t =
                    "<div class='notification error' style='display:none'><p><i class='mdi mdi-alert-octagon'></i>Combo already exists</p></div>";
                $("body").append(t),
                    $(".notification").fadeIn(),
                    $(".notification")
                        .delay(3e3)
                        .fadeOut(300, function () {
                            $(this).remove();
                        });
            }
            if (t.dp) {
                if($('#daySelect').val() == 'today'){dp = 'tomorrow'}else{dp = 'today'}
                let t =
                    "<div class='notification error' style='display:none'><p><i class='mdi mdi-alert-octagon'></i>Cart has "+dp+" product, Please Clear and continue!</p></div>";
                $("body").append(t),
                    $(".notification").fadeIn(),
                    $(".notification")
                        .delay(3e3)
                        .fadeOut(300, function () {
                            $(this).remove();
                        });
            }
        },
        error: function () {
            $(".pre-loader").hide();
            $("body").append(
                "<div class='notification error' style='display:none'><p><i class='mdi mdi-alert-octagon'></i>Unauthorized user!</p></div>"
            ),
                $(".notification").fadeIn(),
                $(".notification")
                    .delay(3e3)
                    .fadeOut(300, function () {
                        $(this).remove();
                    });
        },
    });
}
function updateCart(t, o) {
    $(".pre-loader").show(), (o /= 1e3), (t = t.attr("data-id"));
    let e = 0;
    e =
        "out of stock" === $("#overflow-" + t).text()
            ? $("#final-amount").val()
            : $("#final-amount").val() - $("#price-" + t).val();
    let i = $('meta[name="csrf-token"]').attr("content");
    $.ajax({
        url: "/customer/cart/update/ajax/" + t,
        type: "post",
        data: { _token: i, cart_id: t, qty: o },
        dataType: "json",
        success: function (t) {
            $(".pre-loader").hide();
            var o = JSON.stringify(t.cart.id),
                i = JSON.stringify(t.price);
            if (t.success) {
                $("#price-" + o).val(i.toString().replace(/"/g, ""));
                let t =
                    "<div class='notification success' style='display:none'><p><i class='mdi mdi-alert-octagon'></i>Cart updated</p></div>";
                $("body").append(t);
                let a = parseFloat($("#price-" + o).val()) + e;
                $("#final-amount").val(a.toFixed(2)),
                    $("#overflow-" + o).text(""),
                    $(".notification").fadeIn(),
                    $(".notification")
                        .delay(3e3)
                        .fadeOut(300, function () {
                            $(this).remove();
                        });
            }
            if (t.overflow) {
                $("#price-" + o).val(i.toString().replace(/"/g, ""));
                let t =
                    "<div class='notification error' style='display:none'><p><i class='mdi mdi-alert-octagon'></i>Product quantity out of stock</p></div>";
                $("body").append(t),
                    $("#overflow-" + o).text("out of stock"),
                    $("#final-amount").val(e),
                    $("#final-amount").val(ofa),
                    $(".notification").fadeIn(),
                    $(".notification")
                        .delay(3e3)
                        .fadeOut(300, function () {
                            $(this).remove();
                        });
            }
        },
        error: function () {
            $(".pre-loader").hide();
            $("body").append(
                "<div class='notification error' style='display:none'><p><i class='mdi mdi-alert-octagon'></i>Something wroung!</p></div>"
            ),
                $(".notification").fadeIn(),
                $(".notification")
                    .delay(3e3)
                    .fadeOut(300, function () {
                        $(this).remove();
                    });
        },
    });
}
$(window).on("load", function () {
    $(".pre-loader").fadeOut("slow");
}),
    $(document).on("submit", function () {
        $(".pre-loader").show();
    }),
    $(document).ready(function () {
        $("#mobileBtn").on("click", function () {
            $("#navbarSupportedContent").toggle("1000"),
                $("i", this).toggleClass("mdi-window-close");
        }),
            $("#myCarousel").carousel({ interval: 3500 }),
            $("#myCarousel").on("touchstart", function (t) {
                var o = t.originalEvent.touches[0].pageX;
                $(this).one("touchmove", function (t) {
                    var e = t.originalEvent.touches[0].pageX;
                    Math.floor(o - e) > 1
                        ? $(".carousel").carousel("next")
                        : Math.floor(o - e) < -1 &&
                          $(".carousel").carousel("prev");
                }),
                    $(".carousel").on("touchend", function () {
                        $(this).off("touchmove");
                    });
            }),
            setInterval(function () {
                !(function () {
                    let t = $(".carousel-indicators li.active");
                    $(".carousel-indicators li:last-child").hasClass(
                        "active"
                    ) &&
                        $(".carousel-indicators li:first-child").trigger(
                            "click"
                        ),
                        t.next("li").trigger("click");
                })();
            }, 3e3),
            $(window).scroll(function () {
                $(this).scrollTop()
                    ? $("#toTop:hidden").stop(!0, !0).fadeIn()
                    : $("#toTop").stop(!0, !0).fadeOut();
            }),
            $("#toTop").click(function () {
                $("html, body").animate({ scrollTop: 0 }, 1e3);
            }),
            window.location.hash &&
                ($("#cus-login").hide(), $("#cus-reg").show()),
            $("#reg-btn").click(function () {
                $("#cus-login").hide(),
                    $("#cus-reg").show(),
                    (window.location.hash = "reg");
            }),
            $("#login-btn").click(function () {
                $("#cus-login").show(),
                    $("#cus-reg").hide(),
                    window.history.pushState(
                        null,
                        "",
                        window.location.href.replace("#reg", "")
                    );
            }),
            $("#change-btn").click(function () {
                $("#updateModal").modal("toggle"),
                    $("#changePassModal").modal("toggle");
            }),
            $(".notification").fadeIn(),
            $(".notification").delay(6e3).fadeOut(),
            $(".nav-search input").keyup(function () {
                $(".nav-search input").val()
                    ? $(".nav-search .block").show()
                    : $(".nav-search .block").hide();
                let t = $('meta[name="csrf-token"]').attr("content"),
                    o = $(".nav-search input").val();
                if ("" == o)
                    return $(".nav-search .block .search-list").html(
                        '<li class="empty">not found</li>'
                    );
                $.ajax({
                    url: window.location.origin + "/search/result",
                    type: "POST",
                    dataType: "html",
                    data: { _token: t, value: o },
                })
                    .done(function (t) {
                        $(".nav-search .block .search-list").html(t);
                    })
                    .fail(function () {
                        $(".nav-search .block .search-list").html(
                            '<li class="empty">not found</li>'
                        );
                    });
            }),
            $('input[name="delivery_period"]').on("change", function () {
                "custom" == $(this).val()
                    ? $("#custom-delivery").attr("hidden", !1)
                    : ($("#custom-delivery").attr("hidden", !0),
                      $("#delivery-today").prop("checked", !0));
            }),
            $('input[name="coupon"]').on("keyup", function () {
                "" == $('input[name="coupon"]').val()
                    ? $("#couponCheck").attr("disabled", !0)
                    : $("#couponCheck").attr("disabled", !1);
            }),
            $("#couponCheck").on("click", function () {
                $(".pre-loader").show();
                let t = $('input[name="coupon"]').val(),
                    o = $("#final-amount").val(),
                    e = $('meta[name="csrf-token"]').attr("content");
                $.ajax({
                    url: "/customer/cart/coupon/check",
                    type: "post",
                    data: { _token: e, code: t, amount: o },
                    dataType: "json",
                    success: function (t) {
                        $(".pre-loader").hide();
                        let o = JSON.stringify(t.message);
                        if (((o = o.toString().replace(/"/g, "")), t.success)) {
                            let t =
                                "<div class='notification success' style='display:none'><p><i class='mdi mdi-alert-octagon'></i>" +
                                o +
                                "</p></div>";
                            $("body").append(t),
                                $('input[name="coupon"]').attr("readonly", !0),
                                $("#couponCheck").attr("disabled", !0),
                                $(".notification").fadeIn(),
                                $(".notification")
                                    .delay(3e3)
                                    .fadeOut(300, function () {
                                        $(this).remove();
                                    });
                        }
                        if (t.invalid) {
                            let t =
                                "<div class='notification error' style='display:none'><p><i class='mdi mdi-alert-octagon'></i>" +
                                o +
                                "</p></div>";
                            $("body").append(t),
                                $('input[name="coupon"]').val(""),
                                $("#couponCheck").attr("disabled", !0),
                                $(".notification").fadeIn(),
                                $(".notification")
                                    .delay(3e3)
                                    .fadeOut(300, function () {
                                        $(this).remove();
                                    });
                        }
                    },
                    error: function () {
                        $(".pre-loader").hide();
                        $("body").append(
                            "<div class='notification error' style='display:none'><p><i class='mdi mdi-alert-octagon'></i>Something wroung!</p></div>"
                        ),
                            $(".notification").fadeIn(),
                            $(".notification")
                                .delay(3e3)
                                .fadeOut(300, function () {
                                    $(this).remove();
                                });
                    },
                });
            });
            if ($(window).width() < 991){
                let g = $('.lap-day').html();
                $('.lap-day').empty();
                $('.mob-day').html(g);
            }
            $('#daySelect').on('change',() => {
                let base = window.location.href;
                let d = $('#daySelect').val();
                if (base.indexOf('?day') > -1){
                    base = base.replace(/\?.+/g,"$'")
                }
                window.location.href = base+"?day="+d;
            });
    }),
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
function beforeCart(m){
    let t = m.find('.price_type:checked').val();
    let q = m.find('.price_type:checked').attr('data-qty');
    q = q * 1000;
    let spid = m.find('.spid').val();
    $('#beforeCartModal').modal('toggle');
    $('#beforeCartModal #sepq').val(q);
    $('#beforeCartModal #sepq').attr('min',q);
    $('#beforeCartModal #spid').val(spid);
    $('#beforeCartModal #sept').val(t);
}
function beforeCartCombo(id,q){
    $('#beforeCartComboModal').modal('toggle');
    $('#beforeCartComboModal #cepq').val(q);
    $('#beforeCartComboModal #cepq').attr('min',q);
    $('#beforeCartComboModal #cepid').val(id);
}
$('#beforeCartForm').on('submit',function(e){
    let t = $('#sept').val();
    let spid = $('#spid').val();
    let q = $('#sepq').val();
    q = q / 1000;
    let d = $('#daySelect').val();
    addCart(spid, q, t,d);
    e.preventDefault();
});
$('#beforeCartComboForm').on('submit',function(e){
    let id = $('#cepid').val();
    let q = $('#cepq').val();
    let d = $('#daySelect').val();
    addCombo(id, q,d);
    e.preventDefault();
});
