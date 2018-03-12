## وب سرویس های سیب دایت

نشانه های استفاده شده:
```
[K] = کلید شناسایی نمایندگی
[P]= شماره پرونده مشتری
[M] = شماره موبایل ثبت شده مشتری در سیب دایت
[D] = شناسه رژیم
```

1- گرفتن اطلاعات پروفایل فرد: 
http://sibdiet.net/webservice/get/sibdiet3/profile?api_key=[K]&p=[P]&m=[M]
    2- بازیابی شماره پرونده های فرد توسط موبایل: (شماره پرونده های ثبت شده با این موبایل برای موبایل فرد اس ام اس می گردد)
http://sibdiet.net/webservice/get/sibdiet3/profile?api_key=[K]&m=[M]
    3- دریافت لیست رژیم های فرد:
http://sibdiet.net/webservice/get/sibdiet3/diets?api_key=[K]&p=[P]&m=[M]
    4- دریافت اطلاعات یک رژیم:
http://sibdiet.net/webservice/get/sibdiet3/diet?api_key=[K]&p=[P]&m=[M]&d=[D]
    5- به روز رسانی اطلاعات پروفایل:
http://sibdiet.net/webservice/put/sibdiet3/profile?api_key=[K]&p=[P]&m=[M]&profile=[Profile]
متغیر [Profile] : که به صورت json باید باشد. مثال:
{"birthday":"1994-01-01", "gender":"MALE", "marital":"SINGLE", "education":"BACHELOR", "blood":"AB-", "job":"Manager", "country":"IR", "city":"mashhad", "homephone":"0211234567", "homeaddress":"Mashhad No 3", "mobile"="New mobile"}
نکات:
    • در متغیر profile می توانید فقط گزینه هایی که تغییر می کند را ارسال کنید و نیاز به تکمیل همه گزینه ها نیست.
    • در صورتی که فرد خواست شماره موبایل خود را تغییر دهد، شماره موبایل قبلی را در متغیر m و شماره جدید را در متغیر mobile در متغیر profile ارسال نمایید. قبل از ارسال حتما از صحت شماره موبایل جدید مطمئن شوید.
    • نام و نام خانوادگی را نمی شود تغییر داد و جهت تغییر باید با مطب تماس گرفته شود.
    • حتما اعلام کنید که هر کاربر در پرونده خودش فقط برای خودش می تواند رژیم درخواس کند و برای بقیه خانواده باید پرونده جدید تشکیل بدهد.
    6- درخواست رژیم جدید:
http://sibdiet.net/webservice/post/sibdiet3/diet?api_key=[K]&p=[P]&m=[M]&diet=[Diet]
    • متغیر [Diet]: نمونه را آماده و ارسال می کنم
    • در جواب در صورت موفقیت: شناسه رژیم را دریافت می کنید.
    7- ثبت نام جدید و دریافت شماره پرونده:
http://sibdiet.net/webservice/post/sibdiet3/profile?api_key=[K]&profile=[Profile]
    • در این وب سرویس باید تمامی متغیرهای profile تکمیل شود. نمونه:
{"fname":"test", "lname":"mazaj", "mobile":"09125521498", "birthday":"1994-01-01" , "gender":"MALE", "marital":"SINGLE", "education":"BACHELOR", "blood":"AB-", "job":"Manager", "country":"IR", "city":"qom", "homephone":"0211234567", "homeaddress":"Mashhad No 3"}
    • در پاسخ این وب سرویس در صورت موفقیت شماره پرونده فرد را دریافت خواهید کرد.

نکته: در تمامی وب سرویس ها در صورت خطا مقدار status مقدار ko خواهد بود و در دو متغیر زیر نیز برگدانده می شود:
