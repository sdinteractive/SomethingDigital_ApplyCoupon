var coupon_code = getQueryString('coupon_code');

if(coupon_code) {
  var date = new Date();
  date.setTime(date.getTime()+(2*60*60*1000));
  var expires = "; expires="+date.toGMTString();
  document.cookie = "coupon_code=" + coupon_code + expires + "; path=/";
}

function getQueryString( field, url ) {
  var href = url ? url : window.location.href;
  var reg = new RegExp( '[?&]' + field + '=([^&#]*)', 'i' );
  var string = reg.exec(href);
  return string ? string[1] : null;
};
