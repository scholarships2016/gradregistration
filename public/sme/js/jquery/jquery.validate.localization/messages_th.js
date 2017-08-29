(function( factory ) {
	if ( typeof define === "function" && define.amd ) {
		define( ["jquery", "../jquery.validate"], factory );
	} else if (typeof module === "object" && module.exports) {
		module.exports = factory( require( "jquery" ) );
	} else {
		factory( jQuery );
	}
}(function( $ ) {

/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: TH (Thai; ไทย)
 */
$.extend( $.validator.messages, {
	required: "โปรดระบุ",
	remote: "โปรดแก้ไขให้ถูกต้อง",
	email: "โปรดระบุที่อยู่อีเมล์ที่ถูกต้อง",
	url: "โปรดระบุ URL ที่ถูกต้อง",
	date: "โปรดระบุวันที่ ที่ถูกต้อง",
	dateISO: "โปรดระบุวันที่ ที่ถูกต้อง (ระบบ ISO).",
	number: "โปรดระบุทศนิยมที่ถูกต้อง",
	digits: "โปรดระบุจำนวนเต็มที่ถูกต้อง",
	creditcard: "โปรดระบุรหัสบัตรเครดิตที่ถูกต้อง",
	equalTo: "โปรดระบุค่าเดิมอีกครั้ง",
	extension: "โปรดระบุค่าที่มีส่วนขยายที่ถูกต้อง",
	maxlength: $.validator.format( "กรุณากรอกข้อมูลไม่เกิน {0} ตัวอักษร" ),
	minlength: $.validator.format( "กรุณากรอกข้อมูลไม่น้อยกว่า {0} ตัวอักษร" ),
	rangelength: $.validator.format( "กรุณากรอกข้อมูลระหว่าง {0} ถึง {1} ตัวอักษร" ),
	range: $.validator.format( "กรุณากรอกค่าระหว่าง {0} และ {1}" ),
	max: $.validator.format( "กรุณากรอกค่าน้อยกว่าหรือเท่ากับ {0}" ),
	min: $.validator.format( "กรุณากรอกค่ามากกว่าหรือเท่ากับ {0}" )
} );
return $;
}));