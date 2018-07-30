var popup = {
    init: function() {
        $("#m_sweetalert_demo_1").click(function(e) {
            swal("Good job!")
        }), $("#m_sweetalert_demo_2").click(function(e) {
            swal("Here's the title!", "...and here's the text!")
        }), $("#m_sweetalert_demo_3_1").click(function(e) {
            swal("Good job!", "You clicked the button!", "warning")
        }), $("#m_sweetalert_demo_3_2").click(function(e) {
            swal("Good job!", "You clicked the button!", "error")
        }), $("#m_sweetalert_demo_3_3").click(function(e) {
            swal("Good job!", "You clicked the button!", "success")
        }), $("#m_sweetalert_demo_3_4").click(function(e) {
            swal("Good job!", "You clicked the button!", "info")
        }), $("#m_sweetalert_demo_3_5").click(function(e) {
            swal("Good job!", "You clicked the button!", "question")
        }), $("#m_sweetalert_demo_4").click(function(e) {
            swal({
                title: "Good job!",
                text: "You clicked the button!",
                icon: "success",
                confirmButtonText: "Confirm me!",
                confirmButtonClass: "btn btn-focus m-btn m-btn--pill m-btn--air"
            })
        }), $("#m_sweetalert_demo_5").click(function(e) {
            swal({
                title: "Good job!",
                text: "You clicked the button!",
                icon: "success",
                confirmButtonText: "<span><i class='la la-headphones'></i><span>I am game!</span></span>",
                confirmButtonClass: "btn btn-danger m-btn m-btn--pill m-btn--air m-btn--icon",
                showCancelButton: !0,
                cancelButtonText: "<span><i class='la la-thumbs-down'></i><span>No, thanks</span></span>",
                cancelButtonClass: "btn btn-secondary m-btn m-btn--pill m-btn--icon"
            })
        }), $("#m_sweetalert_demo_6").click(function(e) {
            swal({
                position: "top-right",
                type: "success",
                title: "Your work has been saved",
                showConfirmButton: !1,
                timer: 1500
            })
        }), $("#m_sweetalert_demo_7").click(function(e) {
            swal({
                title: "jQuery HTML example",
                html: $("<div>").addClass("some-class").text("jQuery is everywhere."),
                animation: !1,
                customClass: "animated tada"
            })
        }), $("#m_sweetalert_demo_8").click(function(e) {
            swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!"
            }).then(function(e) {
                e.value && swal("Deleted!", "Your file has been deleted.", "success")
            })
        }), $("#m_sweetalert_demo_9").click(function(e) {
            swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then(function(e) {
                e.value ? swal("Deleted!", "Your file has been deleted.", "success") : "cancel" === e.dismiss && swal("Cancelled", "Your imaginary file is safe :)", "error")
            })
        }), $("#m_sweetalert_demo_10").click(function(e) {
            swal({
                title: "Sweet!",
                text: "Modal with a custom image.",
                imageUrl: "https://unsplash.it/400/200",
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: "Custom image",
                animation: !1
            })
        }), $("#m_sweetalert_demo_11").click(function(e) {
            swal({
                title: "Auto close alert!",
                text: "I will close in 5 seconds.",
                timer: 5e3,
                onOpen: function() {
                    swal.showLoading()
                }
            }).then(function(e) {
                "timer" === e.dismiss && console.log("I was closed by the timer")
            })
        })
    }
};
jQuery(document).ready(function() {
    popup.init()
});