(function (e, t, n) {
    var r = function (e) {
        return e.trim ? e.trim() : e.replace(/^\s+|\s+$/g, "")
    };
    var i = function (e, t) {
        return (" " + e.className + " ").indexOf(" " + t + " ") !== -1
    };
    var s = function (e, t) {
        if (!i(e, t)) {
            e.className = e.className === "" ? t : e.className + " " + t
        }
    };
    var o = function (e, t) {
        e.className = r((" " + e.className + " ").replace(" " + t + " ", " "))
    };
    var u = function (e, t) {
        if (e) {
            do {
                if (e.id === t) {
                    return true
                }
                if (e.nodeType === 9) {
                    break
                }
            } while (e = e.parentNode)
        }
        return false
    };
    var a = t.documentElement;
    var f = e.Modernizr.prefixed("transform"),
        l = e.Modernizr.prefixed("transition"),
        c = function () {
            var e = {
                WebkitTransition: "webkitTransitionEnd",
                MozTransition: "transitionend",
                OTransition: "oTransitionEnd otransitionend",
                msTransition: "MSTransitionEnd",
                transition: "transitionend"
            };
            return e.hasOwnProperty(l) ? e[l] : false
        }();
    e.App = function () {
        var n = false,
            r = {};
        var f = t.getElementById("inner-wrap"),
            h = false,
            p = "js-nav";
        r.init = function () {
            if (n) {
                return
            }
            n = true;
            var d = function (e) {
                if (e && e.target === f) {
                    t.removeEventListener(c, d, false)
                }
                h = false
            };
            r.closeNav = function () {
                if (h) {
                    var n = c && l ? parseFloat(e.getComputedStyle(f, "")[l + "Duration"]) : 0;
                    if (n > 0) {
                        t.addEventListener(c, d, false)
                    } else {
                        d(null)
                    }
                }
                o(a, p)
            };
            r.openNav = function () {
                if (h) {
                    return
                }
                s(a, p);
                h = true
                console.log("h is true");
            };
            r.toggleNav = function (e) {
                if (h && i(a, p)) {
                    r.closeNav()
                } else {
                    r.openNav()
                } if (e) {
                    e.preventDefault()
                }
            };
            t.getElementById("open-pageslide").addEventListener("click", r.toggleNav, true);
            t.getElementById("close-pageslide").addEventListener("click", r.toggleNav, false);
            t.addEventListener("click", function (e) {
                if (h && !u(e.target, "pageslide")) {
                    e.preventDefault();
                    r.closeNav()
                }
            }, true);
            s(a, "js-ready")
        };
        return r
    }();
    if (e.addEventListener) {
        e.addEventListener("DOMContentLoaded", e.App.init, false)
    }
})(window, window.document);