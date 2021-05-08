$("#cardtype").on('change',function(){
    if($(this).val()=="1"){
        $("#merID").val("5502223841")
    }
    if($(this).val()=="2"){
        $("#merID").val("3302236573")
    }
})
$("#placeorder").on('mouseover',function(){
    getHash();
})
function hex_sha1(t) {
    return binb2hex(core_sha1(str2binb(t), t.length * chrsz))
}

function b64_sha1(t) {
    return binb2b64(core_sha1(str2binb(t), t.length * chrsz))
}

function str_sha1(t) {
    return binb2str(core_sha1(str2binb(t), t.length * chrsz))
}

function hex_hmac_sha1(t, r) {
    return binb2hex(core_hmac_sha1(t, r))
}

function b64_hmac_sha1(t, r) {
    return binb2b64(core_hmac_sha1(t, r))
}

function str_hmac_sha1(t, r) {
    return binb2str(core_hmac_sha1(t, r))
}

function sha1_vm_test() {
    return "a9993e364706816aba3e25717850c26c9cd0d89d" == hex_sha1("abc")
}

function core_sha1(t, r) {
    t[r >> 5] |= 128 << 24 - r % 32, t[(r + 64 >> 9 << 4) + 15] = r;
    for (var n = Array(80), e = 1732584193, i = -271733879, a = -1732584194, s = 271733878, o = -1009589776, c = 0; c < t.length; c += 16) {
        for (var h = e, f = i, u = a, l = s, d = o, _ = 0; 80 > _; _++) {
            n[_] = 16 > _ ? t[c + _] : rol(n[_ - 3] ^ n[_ - 8] ^ n[_ - 14] ^ n[_ - 16], 1);
            var p = safe_add(safe_add(rol(e, 5), sha1_ft(_, i, a, s)), safe_add(safe_add(o, n[_]), sha1_kt(_)));
            o = s, s = a, a = rol(i, 30), i = e, e = p
        }
        e = safe_add(e, h), i = safe_add(i, f), a = safe_add(a, u), s = safe_add(s, l), o = safe_add(o, d)
    }
    return Array(e, i, a, s, o)
}

function sha1_ft(t, r, n, e) {
    return 20 > t ? r & n | ~r & e : 40 > t ? r ^ n ^ e : 60 > t ? r & n | r & e | n & e : r ^ n ^ e
}

function sha1_kt(t) {
    return 20 > t ? 1518500249 : 40 > t ? 1859775393 : 60 > t ? -1894007588 : -899497514
}

function core_hmac_sha1(t, r) {
    var n = str2binb(t);
    n.length > 16 && (n = core_sha1(n, t.length * chrsz));
    for (var e = Array(16), i = Array(16), a = 0; 16 > a; a++) e[a] = 909522486 ^ n[a], i[a] = 1549556828 ^ n[a];
    var s = core_sha1(e.concat(str2binb(r)), 512 + r.length * chrsz);
    return core_sha1(i.concat(s), 672)
}

function safe_add(t, r) {
    var n = (65535 & t) + (65535 & r),
        e = (t >> 16) + (r >> 16) + (n >> 16);
    return e << 16 | 65535 & n
}

function rol(t, r) {
    return t << r | t >>> 32 - r
}

function str2binb(t) {
    for (var r = Array(), n = (1 << chrsz) - 1, e = 0; e < t.length * chrsz; e += chrsz) r[e >> 5] |= (t.charCodeAt(e / chrsz) & n) << 32 - chrsz - e % 32;
    return r
}

function binb2str(t) {
    for (var r = "", n = (1 << chrsz) - 1, e = 0; e < 32 * t.length; e += chrsz) r += String.fromCharCode(t[e >> 5] >>> 32 - chrsz - e % 32 & n);
    return r
}

function binb2hex(t) {
    for (var r = hexcase ? "0123456789ABCDEF" : "0123456789abcdef", n = "", e = 0; e < 4 * t.length; e++) n += r.charAt(t[e >> 2] >> 8 * (3 - e % 4) + 4 & 15) + r.charAt(t[e >> 2] >> 8 * (3 - e % 4) & 15);
    return n
}

function binb2b64(t) {
    for (var r = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/", n = "", e = 0; e < 4 * t.length; e += 3)
        for (var i = (t[e >> 2] >> 8 * (3 - e % 4) & 255) << 16 | (t[e + 1 >> 2] >> 8 * (3 - (e + 1) % 4) & 255) << 8 | t[e + 2 >> 2] >> 8 * (3 - (e + 2) % 4) & 255, a = 0; 4 > a; a++) n += 8 * e + 6 * a > 32 * t.length ? b64pad : r.charAt(i >> 6 * (3 - a) & 63);
    return n
}

function getHash() {
    f.secretString.value = f.invoiceNo.value + f.amount.value + f.secretCode.value + f.merID.value + f.PAN.value + f.expiryDate.value + f.CVV2.value, f.sha1.checked ? (f.securityMethod.value = "SHA1", f.securityKeyReq.value = b64_sha1(f.secretString.value)) : (f.securityMethod.value = "", f.securityKeyReq.value = CryptoJS.SHA256(f.secretString.value).toString(CryptoJS.enc.Base64))
}
var hexcase = 0,
    b64pad = "=",
    chrsz = 8,
    CryptoJS = CryptoJS || function(t, r) {
        var n = {},
            e = n.lib = {},
            i = function() {},
            a = e.Base = {
                extend: function(t) {
                    i.prototype = this;
                    var r = new i;
                    return t && r.mixIn(t), r.hasOwnProperty("init") || (r.init = function() {
                        r.$super.init.apply(this, arguments)
                    }), r.init.prototype = r, r.$super = this, r
                },
                create: function() {
                    var t = this.extend();
                    return t.init.apply(t, arguments), t
                },
                init: function() {},
                mixIn: function(t) {
                    for (var r in t) t.hasOwnProperty(r) && (this[r] = t[r]);
                    t.hasOwnProperty("toString") && (this.toString = t.toString)
                },
                clone: function() {
                    return this.init.prototype.extend(this)
                }
            },
            s = e.WordArray = a.extend({
                init: function(t, n) {
                    t = this.words = t || [], this.sigBytes = n != r ? n : 4 * t.length
                },
                toString: function(t) {
                    return (t || c).stringify(this)
                },
                concat: function(t) {
                    var r = this.words,
                        n = t.words,
                        e = this.sigBytes;
                    if (t = t.sigBytes, this.clamp(), e % 4)
                        for (var i = 0; t > i; i++) r[e + i >>> 2] |= (n[i >>> 2] >>> 24 - 8 * (i % 4) & 255) << 24 - 8 * ((e + i) % 4);
                    else if (65535 < n.length)
                        for (i = 0; t > i; i += 4) r[e + i >>> 2] = n[i >>> 2];
                    else r.push.apply(r, n);
                    return this.sigBytes += t, this
                },
                clamp: function() {
                    var r = this.words,
                        n = this.sigBytes;
                    r[n >>> 2] &= 4294967295 << 32 - 8 * (n % 4), r.length = t.ceil(n / 4)
                },
                clone: function() {
                    var t = a.clone.call(this);
                    return t.words = this.words.slice(0), t
                },
                random: function(r) {
                    for (var n = [], e = 0; r > e; e += 4) n.push(4294967296 * t.random() | 0);
                    return new s.init(n, r)
                }
            }),
            o = n.enc = {},
            c = o.Hex = {
                stringify: function(t) {
                    var r = t.words;
                    t = t.sigBytes;
                    for (var n = [], e = 0; t > e; e++) {
                        var i = r[e >>> 2] >>> 24 - 8 * (e % 4) & 255;
                        n.push((i >>> 4).toString(16)), n.push((15 & i).toString(16))
                    }
                    return n.join("")
                },
                parse: function(t) {
                    for (var r = t.length, n = [], e = 0; r > e; e += 2) n[e >>> 3] |= parseInt(t.substr(e, 2), 16) << 24 - 4 * (e % 8);
                    return new s.init(n, r / 2)
                }
            },
            h = o.Latin1 = {
                stringify: function(t) {
                    var r = t.words;
                    t = t.sigBytes;
                    for (var n = [], e = 0; t > e; e++) n.push(String.fromCharCode(r[e >>> 2] >>> 24 - 8 * (e % 4) & 255));
                    return n.join("")
                },
                parse: function(t) {
                    for (var r = t.length, n = [], e = 0; r > e; e++) n[e >>> 2] |= (255 & t.charCodeAt(e)) << 24 - 8 * (e % 4);
                    return new s.init(n, r)
                }
            },
            f = o.Utf8 = {
                stringify: function(t) {
                    try {
                        return decodeURIComponent(escape(h.stringify(t)))
                    } catch (r) {
                        throw Error("Malformed UTF-8 data")
                    }
                },
                parse: function(t) {
                    return h.parse(unescape(encodeURIComponent(t)))
                }
            },
            u = e.BufferedBlockAlgorithm = a.extend({
                reset: function() {
                    this._data = new s.init, this._nDataBytes = 0
                },
                _append: function(t) {
                    "string" == typeof t && (t = f.parse(t)), this._data.concat(t), this._nDataBytes += t.sigBytes
                },
                _process: function(r) {
                    var n = this._data,
                        e = n.words,
                        i = n.sigBytes,
                        a = this.blockSize,
                        o = i / (4 * a),
                        o = r ? t.ceil(o) : t.max((0 | o) - this._minBufferSize, 0);
                    if (r = o * a, i = t.min(4 * r, i), r) {
                        for (var c = 0; r > c; c += a) this._doProcessBlock(e, c);
                        c = e.splice(0, r), n.sigBytes -= i
                    }
                    return new s.init(c, i)
                },
                clone: function() {
                    var t = a.clone.call(this);
                    return t._data = this._data.clone(), t
                },
                _minBufferSize: 0
            });
        e.Hasher = u.extend({
            cfg: a.extend(),
            init: function(t) {
                this.cfg = this.cfg.extend(t), this.reset()
            },
            reset: function() {
                u.reset.call(this), this._doReset()
            },
            update: function(t) {
                return this._append(t), this._process(), this
            },
            finalize: function(t) {
                return t && this._append(t), this._doFinalize()
            },
            blockSize: 16,
            _createHelper: function(t) {
                return function(r, n) {
                    return new t.init(n).finalize(r)
                }
            },
            _createHmacHelper: function(t) {
                return function(r, n) {
                    return new l.HMAC.init(t, n).finalize(r)
                }
            }
        });
        var l = n.algo = {};
        return n
    }(Math);
! function(t) {
    for (var r = CryptoJS, n = r.lib, e = n.WordArray, i = n.Hasher, n = r.algo, a = [], s = [], o = function(t) {
        return 4294967296 * (t - (0 | t)) | 0
    }, c = 2, h = 0; 64 > h;) {
        var f;
        t: {
            f = c;
            for (var u = t.sqrt(f), l = 2; u >= l; l++)
                if (!(f % l)) {
                    f = !1;
                    break t
                } f = !0
        }
        f && (8 > h && (a[h] = o(t.pow(c, .5))), s[h] = o(t.pow(c, 1 / 3)), h++), c++
    }
    var d = [],
        n = n.SHA256 = i.extend({
            _doReset: function() {
                this._hash = new e.init(a.slice(0))
            },
            _doProcessBlock: function(t, r) {
                for (var n = this._hash.words, e = n[0], i = n[1], a = n[2], o = n[3], c = n[4], h = n[5], f = n[6], u = n[7], l = 0; 64 > l; l++) {
                    if (16 > l) d[l] = 0 | t[r + l];
                    else {
                        var _ = d[l - 15],
                            p = d[l - 2];
                        d[l] = ((_ << 25 | _ >>> 7) ^ (_ << 14 | _ >>> 18) ^ _ >>> 3) + d[l - 7] + ((p << 15 | p >>> 17) ^ (p << 13 | p >>> 19) ^ p >>> 10) + d[l - 16]
                    }
                    _ = u + ((c << 26 | c >>> 6) ^ (c << 21 | c >>> 11) ^ (c << 7 | c >>> 25)) + (c & h ^ ~c & f) + s[l] + d[l], p = ((e << 30 | e >>> 2) ^ (e << 19 | e >>> 13) ^ (e << 10 | e >>> 22)) + (e & i ^ e & a ^ i & a), u = f, f = h, h = c, c = o + _ | 0, o = a, a = i, i = e, e = _ + p | 0
                }
                n[0] = n[0] + e | 0, n[1] = n[1] + i | 0, n[2] = n[2] + a | 0, n[3] = n[3] + o | 0, n[4] = n[4] + c | 0, n[5] = n[5] + h | 0, n[6] = n[6] + f | 0, n[7] = n[7] + u | 0
            },
            _doFinalize: function() {
                var r = this._data,
                    n = r.words,
                    e = 8 * this._nDataBytes,
                    i = 8 * r.sigBytes;
                return n[i >>> 5] |= 128 << 24 - i % 32, n[(i + 64 >>> 9 << 4) + 14] = t.floor(e / 4294967296), n[(i + 64 >>> 9 << 4) + 15] = e, r.sigBytes = 4 * n.length, this._process(), this._hash
            },
            clone: function() {
                var t = i.clone.call(this);
                return t._hash = this._hash.clone(), t
            }
        });
    r.SHA256 = i._createHelper(n), r.HmacSHA256 = i._createHmacHelper(n)
}(Math),
    function() {
        var t = CryptoJS,
            r = t.lib.WordArray;
        t.enc.Base64 = {
            stringify: function(t) {
                var r = t.words,
                    n = t.sigBytes,
                    e = this._map;
                t.clamp(), t = [];
                for (var i = 0; n > i; i += 3)
                    for (var a = (r[i >>> 2] >>> 24 - 8 * (i % 4) & 255) << 16 | (r[i + 1 >>> 2] >>> 24 - 8 * ((i + 1) % 4) & 255) << 8 | r[i + 2 >>> 2] >>> 24 - 8 * ((i + 2) % 4) & 255, s = 0; 4 > s && n > i + .75 * s; s++) t.push(e.charAt(a >>> 6 * (3 - s) & 63));
                if (r = e.charAt(64))
                    for (; t.length % 4;) t.push(r);
                return t.join("")
            },
            parse: function(t) {
                var n = t.length,
                    e = this._map,
                    i = e.charAt(64);
                i && (i = t.indexOf(i), -1 != i && (n = i));
                for (var i = [], a = 0, s = 0; n > s; s++)
                    if (s % 4) {
                        var o = e.indexOf(t.charAt(s - 1)) << 2 * (s % 4),
                            c = e.indexOf(t.charAt(s)) >>> 6 - 2 * (s % 4);
                        i[a >>> 2] |= (o | c) << 24 - 8 * (a % 4), a++
                    } return r.create(i, a)
            },
            _map: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/="
        }
    }();
