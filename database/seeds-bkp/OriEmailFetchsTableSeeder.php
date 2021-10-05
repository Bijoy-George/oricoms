<?php

use Illuminate\Database\Seeder;

class OriEmailFetchsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_email_fetchs')->delete();
        
        \DB::table('ori_email_fetchs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'email_id' => 1,
                'thread_id' => 1,
                'from' => 'rejeesh.nair@orisys.in',
                'from_name' => 'Rejeesh Nair <rejeesh.nair@orisys.in>',
                'subject' => 'Test Sub2',
                'message' => '4oCLZ2ZkZyBmZGcgZGZnZmQgZGZn4oCLDQo',
                'received_date' => '2017-08-07 03:23:26',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-09 10:12:25',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'email_id' => 2,
                'thread_id' => 2,
                'from' => 'rejeesh.nair@orisys.in',
                'from_name' => 'Rejeesh Nair <rejeesh.nair@orisys.in>',
                'subject' => 'Test SUb3',
                'message' => 'Content3',
                'received_date' => '2017-08-07 03:25:38',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-09 10:12:26',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'cmpny_id' => 2,
                'email_id' => 3,
                'thread_id' => 3,
                'from' => 'rejeesh.nair@orisys.in',
                'from_name' => 'Rejeesh Nair <rejeesh.nair@orisys.in>',
                'subject' => 'Sub4',
                'message' => '4oCLVGVzdCBjb250ZW504oCLDQo',
                'received_date' => '2017-08-07 03:54:22',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-09 10:12:27',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'cmpny_id' => 2,
                'email_id' => 4,
                'thread_id' => 4,
                'from' => 'rejeesh.nair@orisys.in',
                'from_name' => 'Rejeesh Nair <rejeesh.nair@orisys.in>',
                'subject' => 'Sub5',
                'message' => 'Content5',
                'received_date' => '2017-08-07 06:42:25',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-09 10:12:27',
                'updated_at' => '2018-10-15 06:53:25',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'cmpny_id' => 2,
                'email_id' => 5,
                'thread_id' => 5,
                'from' => 'akhil.murukan@orisys.in',
                'from_name' => 'Akhil Murukan <akhil.murukan@orisys.in>',
                'subject' => 'test email from akhil',
                'message' => 'hai

On Mon, Aug 7, 2017 at 8:48 AM, Akhil Murukan <akhil.murukan@orisys.in>
wrote:

> Hi, Orisys
> please find the attached document
>
> --
> Regards,
> *AKHIL MURUKAN*
> Software Engineer
>
>
> *  OrisysIndia Consultancy Services LLP​.​*
> ​
> "Driven by People, Technology & Values"
> ​
>
> ​​
> Floor (-
> ​2​
> ), Thejaswini, Technopark
>     Thiruvananthapuram, Kerala, India, PIN 695 581
>
>
> ​   Office ​
> : +91
> ​​04714015757
> ​   Web
> :
> ​​
> ​
> www.orisys.in​
>
> ​   Blog  :​
> ​www.orisys.in/blog
>
>
> Disclaimer : This email and any files transmitted with it are confidential
> and intended solely for the use of the individual or entity to whom they
> are addressed. If you have received this email in error please notify us.
> This message contains confidential information and is intended only for the
> individual named. If you are not the named addressee you should not
> disseminate, distribute or copy this e-mail. Please notify the sender
> immediately by e-mail if you have received this e-mail by mistake and
> delete this e-mail from your system. If you are not the intended recipient
> you are notified that disclosing, copying, distributing or taking any
> action in reliance on the contents of this information is strictly
> prohibited.
>
>


-- 
Regards,
*AKHIL MURUKAN*
Software Engineer


*  OrisysIndia Consultancy Services LLP​.​*
​
"Driven by People, Technology & Values"
​

​​
Floor (-
​2​
), Thejaswini, Technopark
Thiruvananthapuram, Kerala, India, PIN 695 581


​   Office ​
: +91
​​04714015757
​   Web
:
​​
​
www.orisys.in​

​   Blog  :​
​www.orisys.in/blog


Disclaimer : This email and any files transmitted with it are confidential
and intended solely for the use of the individual or entity to whom they
are addressed. If you have received this email in error please notify us.
This message contains confidential information and is intended only for the
individual named. If you are not the named addressee you should not
disseminate, distribute or copy this e-mail. Please notify the sender
immediately by e-mail if you have received this e-mail by mistake and
delete this e-mail from your system. If you are not the intended recipient
you are notified that disclosing, copying, distributing or taking any
action in reliance on the contents of this information is strictly
prohibited.',
                'received_date' => '2017-08-07 09:12:36',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-09 10:12:28',
                'updated_at' => '2018-10-15 06:49:41',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'cmpny_id' => 2,
                'email_id' => 6,
                'thread_id' => 5,
                'from' => 'akhil.murukan@orisys.in',
                'from_name' => 'Akhil Murukan <akhil.murukan@orisys.in>',
                'subject' => 'test email from akhil',
                'message' => 'haiiiiiiiiiii

On Mon, Aug 7, 2017 at 2:42 PM, Akhil Murukan <akhil.murukan@orisys.in>
wrote:

> hai
>
> On Mon, Aug 7, 2017 at 8:48 AM, Akhil Murukan <akhil.murukan@orisys.in>
> wrote:
>
>> Hi, Orisys
>> please find the attached document
>>
>> --
>> Regards,
>> *AKHIL MURUKAN*
>> Software Engineer
>>
>>
>> *  OrisysIndia Consultancy Services LLP​.​*
>> ​
>> "Driven by People, Technology & Values"
>> ​
>>
>> ​​
>> Floor (-
>> ​2​
>> ), Thejaswini, Technopark
>>     Thiruvananthapuram, Kerala, India, PIN 695 581
>>
>>
>> ​   Office ​
>> : +91
>> ​​04714015757
>> ​   Web
>> :
>> ​​
>> ​
>> www.orisys.in​
>>
>> ​   Blog  :​
>> ​www.orisys.in/blog
>>
>>
>> Disclaimer : This email and any files transmitted with it are
>> confidential and intended solely for the use of the individual or entity to
>> whom they are addressed. If you have received this email in error please
>> notify us. This message contains confidential information and is intended
>> only for the individual named. If you are not the named addressee you
>> should not disseminate, distribute or copy this e-mail. Please notify the
>> sender immediately by e-mail if you have received this e-mail by mistake
>> and delete this e-mail from your system. If you are not the intended
>> recipient you are notified that disclosing, copying, distributing or taking
>> any action in reliance on the contents of this information is strictly
>> prohibited.
>>
>>
>
>
> --
> Regards,
> *AKHIL MURUKAN*
> Software Engineer
>
>
> *  OrisysIndia Consultancy Services LLP​.​*
> ​
> "Driven by People, Technology & Values"
> ​
>
> ​​
> Floor (-
> ​2​
> ), Thejaswini, Technopark
>     Thiruvananthapuram, Kerala, India, PIN 695 581
>
>
> ​   Office ​
> : +91
> ​​04714015757
> ​   Web
> :
> ​​
> ​
> www.orisys.in​
>
> ​   Blog  :​
> ​www.orisys.in/blog
>
>
> Disclaimer : This email and any files transmitted with it are confidential
> and intended solely for the use of the individual or entity to whom they
> are addressed. If you have received this email in error please notify us.
> This message contains confidential information and is intended only for the
> individual named. If you are not the named addressee you should not
> disseminate, distribute or copy this e-mail. Please notify the sender
> immediately by e-mail if you have received this e-mail by mistake and
> delete this e-mail from your system. If you are not the intended recipient
> you are notified that disclosing, copying, distributing or taking any
> action in reliance on the contents of this information is strictly
> prohibited.
>
>


-- 
Regards,
*AKHIL MURUKAN*
Software Engineer


*  OrisysIndia Consultancy Services LLP​.​*
​
"Driven by People, Technology & Values"
​

​​
Floor (-
​2​
), Thejaswini, Technopark
Thiruvananthapuram, Kerala, India, PIN 695 581


​   Office ​
: +91
​​04714015757
​   Web
:
​​
​
www.orisys.in​

​   Blog  :​
​www.orisys.in/blog


Disclaimer : This email and any files transmitted with it are confidential
and intended solely for the use of the individual or entity to whom they
are addressed. If you have received this email in error please notify us.
This message contains confidential information and is intended only for the
individual named. If you are not the named addressee you should not
disseminate, distribute or copy this e-mail. Please notify the sender
immediately by e-mail if you have received this e-mail by mistake and
delete this e-mail from your system. If you are not the intended recipient
you are notified that disclosing, copying, distributing or taking any
action in reliance on the contents of this information is strictly
prohibited.',
                'received_date' => '2017-08-08 06:36:46',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-09 10:12:30',
                'updated_at' => '2018-10-15 06:49:41',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'cmpny_id' => 2,
                'email_id' => 7,
                'thread_id' => 5,
                'from' => 'akhil.murukan@orisys.in',
                'from_name' => 'Akhil Murukan <akhil.murukan@orisys.in>',
                'subject' => 'test email from akhil',
                'message' => 'fgfgsdgds

On Tue, Aug 8, 2017 at 12:06 PM, Akhil Murukan <akhil.murukan@orisys.in>
wrote:

> haiiiiiiiiiii
>
> On Mon, Aug 7, 2017 at 2:42 PM, Akhil Murukan <akhil.murukan@orisys.in>
> wrote:
>
>> hai
>>
>> On Mon, Aug 7, 2017 at 8:48 AM, Akhil Murukan <akhil.murukan@orisys.in>
>> wrote:
>>
>>> Hi, Orisys
>>> please find the attached document
>>>
>>> --
>>> Regards,
>>> *AKHIL MURUKAN*
>>> Software Engineer
>>>
>>>
>>> *  OrisysIndia Consultancy Services LLP​.​*
>>> ​
>>> "Driven by People, Technology & Values"
>>> ​
>>>
>>> ​​
>>> Floor (-
>>> ​2​
>>> ), Thejaswini, Technopark
>>>     Thiruvananthapuram, Kerala, India, PIN 695 581
>>>
>>>
>>> ​   Office ​
>>> : +91
>>> ​​04714015757
>>> ​   Web
>>> :
>>> ​​
>>> ​
>>> www.orisys.in​
>>>
>>> ​   Blog  :​
>>> ​www.orisys.in/blog
>>>
>>>
>>> Disclaimer : This email and any files transmitted with it are
>>> confidential and intended solely for the use of the individual or entity to
>>> whom they are addressed. If you have received this email in error please
>>> notify us. This message contains confidential information and is intended
>>> only for the individual named. If you are not the named addressee you
>>> should not disseminate, distribute or copy this e-mail. Please notify the
>>> sender immediately by e-mail if you have received this e-mail by mistake
>>> and delete this e-mail from your system. If you are not the intended
>>> recipient you are notified that disclosing, copying, distributing or taking
>>> any action in reliance on the contents of this information is strictly
>>> prohibited.
>>>
>>>
>>
>>
>> --
>> Regards,
>> *AKHIL MURUKAN*
>> Software Engineer
>>
>>
>> *  OrisysIndia Consultancy Services LLP​.​*
>> ​
>> "Driven by People, Technology & Values"
>> ​
>>
>> ​​
>> Floor (-
>> ​2​
>> ), Thejaswini, Technopark
>>     Thiruvananthapuram, Kerala, India, PIN 695 581
>>
>>
>> ​   Office ​
>> : +91
>> ​​04714015757
>> ​   Web
>> :
>> ​​
>> ​
>> www.orisys.in​
>>
>> ​   Blog  :​
>> ​www.orisys.in/blog
>>
>>
>> Disclaimer : This email and any files transmitted with it are
>> confidential and intended solely for the use of the individual or entity to
>> whom they are addressed. If you have received this email in error please
>> notify us. This message contains confidential information and is intended
>> only for the individual named. If you are not the named addressee you
>> should not disseminate, distribute or copy this e-mail. Please notify the
>> sender immediately by e-mail if you have received this e-mail by mistake
>> and delete this e-mail from your system. If you are not the intended
>> recipient you are notified that disclosing, copying, distributing or taking
>> any action in reliance on the contents of this information is strictly
>> prohibited.
>>
>>
>
>
> --
> Regards,
> *AKHIL MURUKAN*
> Software Engineer
>
>
> *  OrisysIndia Consultancy Services LLP​.​*
> ​
> "Driven by People, Technology & Values"
> ​
>
> ​​
> Floor (-
> ​2​
> ), Thejaswini, Technopark
>     Thiruvananthapuram, Kerala, India, PIN 695 581
>
>
> ​   Office ​
> : +91
> ​​04714015757
> ​   Web
> :
> ​​
> ​
> www.orisys.in​
>
> ​   Blog  :​
> ​www.orisys.in/blog
>
>
> Disclaimer : This email and any files transmitted with it are confidential
> and intended solely for the use of the individual or entity to whom they
> are addressed. If you have received this email in error please notify us.
> This message contains confidential information and is intended only for the
> individual named. If you are not the named addressee you should not
> disseminate, distribute or copy this e-mail. Please notify the sender
> immediately by e-mail if you have received this e-mail by mistake and
> delete this e-mail from your system. If you are not the intended recipient
> you are notified that disclosing, copying, distributing or taking any
> action in reliance on the contents of this information is strictly
> prohibited.
>
>


-- 
Regards,
*AKHIL MURUKAN*
Software Engineer


*  OrisysIndia Consultancy Services LLP​.​*
​
"Driven by People, Technology & Values"
​

​​
Floor (-
​2​
), Thejaswini, Technopark
Thiruvananthapuram, Kerala, India, PIN 695 581


​   Office ​
: +91
​​04714015757
​   Web
:
​​
​
www.orisys.in​

​   Blog  :​
​www.orisys.in/blog


Disclaimer : This email and any files transmitted with it are confidential
and intended solely for the use of the individual or entity to whom they
are addressed. If you have received this email in error please notify us.
This message contains confidential information and is intended only for the
individual named. If you are not the named addressee you should not
disseminate, distribute or copy this e-mail. Please notify the sender
immediately by e-mail if you have received this e-mail by mistake and
delete this e-mail from your system. If you are not the intended recipient
you are notified that disclosing, copying, distributing or taking any
action in reliance on the contents of this information is strictly
prohibited.',
                'received_date' => '2017-08-08 07:35:07',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-09 10:12:32',
                'updated_at' => '2018-10-15 06:49:41',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'cmpny_id' => 2,
                'email_id' => 8,
                'thread_id' => 5,
                'from' => 'akhil.murukan@orisys.in',
                'from_name' => 'Akhil Murukan <akhil.murukan@orisys.in>',
                'subject' => 'test email from akhil',
                'message' => 'hai,

On Tue, Aug 8, 2017 at 1:05 PM, Akhil Murukan <akhil.murukan@orisys.in>
wrote:

> fgfgsdgds
>
> On Tue, Aug 8, 2017 at 12:06 PM, Akhil Murukan <akhil.murukan@orisys.in>
> wrote:
>
>> haiiiiiiiiiii
>>
>> On Mon, Aug 7, 2017 at 2:42 PM, Akhil Murukan <akhil.murukan@orisys.in>
>> wrote:
>>
>>> hai
>>>
>>> On Mon, Aug 7, 2017 at 8:48 AM, Akhil Murukan <akhil.murukan@orisys.in>
>>> wrote:
>>>
>>>> Hi, Orisys
>>>> please find the attached document
>>>>
>>>> --
>>>> Regards,
>>>> *AKHIL MURUKAN*
>>>> Software Engineer
>>>>
>>>>
>>>> *  OrisysIndia Consultancy Services LLP​.​*
>>>> ​
>>>> "Driven by People, Technology & Values"
>>>> ​
>>>>
>>>> ​​
>>>> Floor (-
>>>> ​2​
>>>> ), Thejaswini, Technopark
>>>>     Thiruvananthapuram, Kerala, India, PIN 695 581
>>>>
>>>>
>>>> ​   Office ​
>>>> : +91
>>>> ​​04714015757
>>>> ​   Web
>>>> :
>>>> ​​
>>>> ​
>>>> www.orisys.in​
>>>>
>>>> ​   Blog  :​
>>>> ​www.orisys.in/blog
>>>>
>>>>
>>>> Disclaimer : This email and any files transmitted with it are
>>>> confidential and intended solely for the use of the individual or entity to
>>>> whom they are addressed. If you have received this email in error please
>>>> notify us. This message contains confidential information and is intended
>>>> only for the individual named. If you are not the named addressee you
>>>> should not disseminate, distribute or copy this e-mail. Please notify the
>>>> sender immediately by e-mail if you have received this e-mail by mistake
>>>> and delete this e-mail from your system. If you are not the intended
>>>> recipient you are notified that disclosing, copying, distributing or taking
>>>> any action in reliance on the contents of this information is strictly
>>>> prohibited.
>>>>
>>>>
>>>
>>>
>>> --
>>> Regards,
>>> *AKHIL MURUKAN*
>>> Software Engineer
>>>
>>>
>>> *  OrisysIndia Consultancy Services LLP​.​*
>>> ​
>>> "Driven by People, Technology & Values"
>>> ​
>>>
>>> ​​
>>> Floor (-
>>> ​2​
>>> ), Thejaswini, Technopark
>>>     Thiruvananthapuram, Kerala, India, PIN 695 581
>>>
>>>
>>> ​   Office ​
>>> : +91
>>> ​​04714015757
>>> ​   Web
>>> :
>>> ​​
>>> ​
>>> www.orisys.in​
>>>
>>> ​   Blog  :​
>>> ​www.orisys.in/blog
>>>
>>>
>>> Disclaimer : This email and any files transmitted with it are
>>> confidential and intended solely for the use of the individual or entity to
>>> whom they are addressed. If you have received this email in error please
>>> notify us. This message contains confidential information and is intended
>>> only for the individual named. If you are not the named addressee you
>>> should not disseminate, distribute or copy this e-mail. Please notify the
>>> sender immediately by e-mail if you have received this e-mail by mistake
>>> and delete this e-mail from your system. If you are not the intended
>>> recipient you are notified that disclosing, copying, distributing or taking
>>> any action in reliance on the contents of this information is strictly
>>> prohibited.
>>>
>>>
>>
>>
>> --
>> Regards,
>> *AKHIL MURUKAN*
>> Software Engineer
>>
>>
>> *  OrisysIndia Consultancy Services LLP​.​*
>> ​
>> "Driven by People, Technology & Values"
>> ​
>>
>> ​​
>> Floor (-
>> ​2​
>> ), Thejaswini, Technopark
>>     Thiruvananthapuram, Kerala, India, PIN 695 581
>>
>>
>> ​   Office ​
>> : +91
>> ​​04714015757
>> ​   Web
>> :
>> ​​
>> ​
>> www.orisys.in​
>>
>> ​   Blog  :​
>> ​www.orisys.in/blog
>>
>>
>> Disclaimer : This email and any files transmitted with it are
>> confidential and intended solely for the use of the individual or entity to
>> whom they are addressed. If you have received this email in error please
>> notify us. This message contains confidential information and is intended
>> only for the individual named. If you are not the named addressee you
>> should not disseminate, distribute or copy this e-mail. Please notify the
>> sender immediately by e-mail if you have received this e-mail by mistake
>> and delete this e-mail from your system. If you are not the intended
>> recipient you are notified that disclosing, copying, distributing or taking
>> any action in reliance on the contents of this information is strictly
>> prohibited.
>>
>>
>
>
> --
> Regards,
> *AKHIL MURUKAN*
> Software Engineer
>
>
> *  OrisysIndia Consultancy Services LLP​.​*
> ​
> "Driven by People, Technology & Values"
> ​
>
> ​​
> Floor (-
> ​2​
> ), Thejaswini, Technopark
>     Thiruvananthapuram, Kerala, India, PIN 695 581
>
>
> ​   Office ​
> : +91
> ​​04714015757
> ​   Web
> :
> ​​
> ​
> www.orisys.in​
>
> ​   Blog  :​
> ​www.orisys.in/blog
>
>
> Disclaimer : This email and any files transmitted with it are confidential
> and intended solely for the use of the individual or entity to whom they
> are addressed. If you have received this email in error please notify us.
> This message contains confidential information and is intended only for the
> individual named. If you are not the named addressee you should not
> disseminate, distribute or copy this e-mail. Please notify the sender
> immediately by e-mail if you have received this e-mail by mistake and
> delete this e-mail from your system. If you are not the intended recipient
> you are notified that disclosing, copying, distributing or taking any
> action in reliance on the contents of this information is strictly
> prohibited.
>
>


-- 
Regards,
*AKHIL MURUKAN*
Software Engineer


*  OrisysIndia Consultancy Services LLP​.​*
​
"Driven by People, Technology & Values"
​

​​
Floor (-
​2​
), Thejaswini, Technopark
Thiruvananthapuram, Kerala, India, PIN 695 581


​   Office ​
: +91
​​04714015757
​   Web
:
​​
​
www.orisys.in​

​   Blog  :​
​www.orisys.in/blog


Disclaimer : This email and any files transmitted with it are confidential
and intended solely for the use of the individual or entity to whom they
are addressed. If you have received this email in error please notify us.
This message contains confidential information and is intended only for the
individual named. If you are not the named addressee you should not
disseminate, distribute or copy this e-mail. Please notify the sender
immediately by e-mail if you have received this e-mail by mistake and
delete this e-mail from your system. If you are not the intended recipient
you are notified that disclosing, copying, distributing or taking any
action in reliance on the contents of this information is strictly
prohibited.',
                'received_date' => '2017-08-08 08:54:21',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-09 10:12:33',
                'updated_at' => '2018-10-15 06:49:41',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'cmpny_id' => 2,
                'email_id' => 9,
                'thread_id' => 5,
                'from' => 'akhil.murukan@orisys.in',
                'from_name' => 'Akhil Murukan <akhil.murukan@orisys.in>',
                'subject' => 'test email from akhil',
                'message' => 'hiiii

On Tue, Aug 8, 2017 at 2:24 PM, Akhil Murukan <akhil.murukan@orisys.in>
wrote:

> hai,
>
> On Tue, Aug 8, 2017 at 1:05 PM, Akhil Murukan <akhil.murukan@orisys.in>
> wrote:
>
>> fgfgsdgds
>>
>> On Tue, Aug 8, 2017 at 12:06 PM, Akhil Murukan <akhil.murukan@orisys.in>
>> wrote:
>>
>>> haiiiiiiiiiii
>>>
>>> On Mon, Aug 7, 2017 at 2:42 PM, Akhil Murukan <akhil.murukan@orisys.in>
>>> wrote:
>>>
>>>> hai
>>>>
>>>> On Mon, Aug 7, 2017 at 8:48 AM, Akhil Murukan <akhil.murukan@orisys.in>
>>>> wrote:
>>>>
>>>>> Hi, Orisys
>>>>> please find the attached document
>>>>>
>>>>> --
>>>>> Regards,
>>>>> *AKHIL MURUKAN*
>>>>> Software Engineer
>>>>>
>>>>>
>>>>> *  OrisysIndia Consultancy Services LLP​.​*
>>>>> ​
>>>>> "Driven by People, Technology & Values"
>>>>> ​
>>>>>
>>>>> ​​
>>>>> Floor (-
>>>>> ​2​
>>>>> ), Thejaswini, Technopark
>>>>>     Thiruvananthapuram, Kerala, India, PIN 695 581
>>>>>
>>>>>
>>>>> ​   Office ​
>>>>> : +91
>>>>> ​​04714015757
>>>>> ​   Web
>>>>> :
>>>>> ​​
>>>>> ​
>>>>> www.orisys.in​
>>>>>
>>>>> ​   Blog  :​
>>>>> ​www.orisys.in/blog
>>>>>
>>>>>
>>>>> Disclaimer : This email and any files transmitted with it are
>>>>> confidential and intended solely for the use of the individual or entity to
>>>>> whom they are addressed. If you have received this email in error please
>>>>> notify us. This message contains confidential information and is intended
>>>>> only for the individual named. If you are not the named addressee you
>>>>> should not disseminate, distribute or copy this e-mail. Please notify the
>>>>> sender immediately by e-mail if you have received this e-mail by mistake
>>>>> and delete this e-mail from your system. If you are not the intended
>>>>> recipient you are notified that disclosing, copying, distributing or taking
>>>>> any action in reliance on the contents of this information is strictly
>>>>> prohibited.
>>>>>
>>>>>
>>>>
>>>>
>>>> --
>>>> Regards,
>>>> *AKHIL MURUKAN*
>>>> Software Engineer
>>>>
>>>>
>>>> *  OrisysIndia Consultancy Services LLP​.​*
>>>> ​
>>>> "Driven by People, Technology & Values"
>>>> ​
>>>>
>>>> ​​
>>>> Floor (-
>>>> ​2​
>>>> ), Thejaswini, Technopark
>>>>     Thiruvananthapuram, Kerala, India, PIN 695 581
>>>>
>>>>
>>>> ​   Office ​
>>>> : +91
>>>> ​​04714015757
>>>> ​   Web
>>>> :
>>>> ​​
>>>> ​
>>>> www.orisys.in​
>>>>
>>>> ​   Blog  :​
>>>> ​www.orisys.in/blog
>>>>
>>>>
>>>> Disclaimer : This email and any files transmitted with it are
>>>> confidential and intended solely for the use of the individual or entity to
>>>> whom they are addressed. If you have received this email in error please
>>>> notify us. This message contains confidential information and is intended
>>>> only for the individual named. If you are not the named addressee you
>>>> should not disseminate, distribute or copy this e-mail. Please notify the
>>>> sender immediately by e-mail if you have received this e-mail by mistake
>>>> and delete this e-mail from your system. If you are not the intended
>>>> recipient you are notified that disclosing, copying, distributing or taking
>>>> any action in reliance on the contents of this information is strictly
>>>> prohibited.
>>>>
>>>>
>>>
>>>
>>> --
>>> Regards,
>>> *AKHIL MURUKAN*
>>> Software Engineer
>>>
>>>
>>> *  OrisysIndia Consultancy Services LLP​.​*
>>> ​
>>> "Driven by People, Technology & Values"
>>> ​
>>>
>>> ​​
>>> Floor (-
>>> ​2​
>>> ), Thejaswini, Technopark
>>>     Thiruvananthapuram, Kerala, India, PIN 695 581
>>>
>>>
>>> ​   Office ​
>>> : +91
>>> ​​04714015757
>>> ​   Web
>>> :
>>> ​​
>>> ​
>>> www.orisys.in​
>>>
>>> ​   Blog  :​
>>> ​www.orisys.in/blog
>>>
>>>
>>> Disclaimer : This email and any files transmitted with it are
>>> confidential and intended solely for the use of the individual or entity to
>>> whom they are addressed. If you have received this email in error please
>>> notify us. This message contains confidential information and is intended
>>> only for the individual named. If you are not the named addressee you
>>> should not disseminate, distribute or copy this e-mail. Please notify the
>>> sender immediately by e-mail if you have received this e-mail by mistake
>>> and delete this e-mail from your system. If you are not the intended
>>> recipient you are notified that disclosing, copying, distributing or taking
>>> any action in reliance on the contents of this information is strictly
>>> prohibited.
>>>
>>>
>>
>>
>> --
>> Regards,
>> *AKHIL MURUKAN*
>> Software Engineer
>>
>>
>> *  OrisysIndia Consultancy Services LLP​.​*
>> ​
>> "Driven by People, Technology & Values"
>> ​
>>
>> ​​
>> Floor (-
>> ​2​
>> ), Thejaswini, Technopark
>>     Thiruvananthapuram, Kerala, India, PIN 695 581
>>
>>
>> ​   Office ​
>> : +91
>> ​​04714015757
>> ​   Web
>> :
>> ​​
>> ​
>> www.orisys.in​
>>
>> ​   Blog  :​
>> ​www.orisys.in/blog
>>
>>
>> Disclaimer : This email and any files transmitted with it are
>> confidential and intended solely for the use of the individual or entity to
>> whom they are addressed. If you have received this email in error please
>> notify us. This message contains confidential information and is intended
>> only for the individual named. If you are not the named addressee you
>> should not disseminate, distribute or copy this e-mail. Please notify the
>> sender immediately by e-mail if you have received this e-mail by mistake
>> and delete this e-mail from your system. If you are not the intended
>> recipient you are notified that disclosing, copying, distributing or taking
>> any action in reliance on the contents of this information is strictly
>> prohibited.
>>
>>
>
>
> --
> Regards,
> *AKHIL MURUKAN*
> Software Engineer
>
>
> *  OrisysIndia Consultancy Services LLP​.​*
> ​
> "Driven by People, Technology & Values"
> ​
>
> ​​
> Floor (-
> ​2​
> ), Thejaswini, Technopark
>     Thiruvananthapuram, Kerala, India, PIN 695 581
>
>
> ​   Office ​
> : +91
> ​​04714015757
> ​   Web
> :
> ​​
> ​
> www.orisys.in​
>
> ​   Blog  :​
> ​www.orisys.in/blog
>
>
> Disclaimer : This email and any files transmitted with it are confidential
> and intended solely for the use of the individual or entity to whom they
> are addressed. If you have received this email in error please notify us.
> This message contains confidential information and is intended only for the
> individual named. If you are not the named addressee you should not
> disseminate, distribute or copy this e-mail. Please notify the sender
> immediately by e-mail if you have received this e-mail by mistake and
> delete this e-mail from your system. If you are not the intended recipient
> you are notified that disclosing, copying, distributing or taking any
> action in reliance on the contents of this information is strictly
> prohibited.
>
>


-- 
Regards,
*AKHIL MURUKAN*
Software Engineer


*  OrisysIndia Consultancy Services LLP​.​*
​
"Driven by People, Technology & Values"
​

​​
Floor (-
​2​
), Thejaswini, Technopark
Thiruvananthapuram, Kerala, India, PIN 695 581


​   Office ​
: +91
​​04714015757
​   Web
:
​​
​
www.orisys.in​

​   Blog  :​
​www.orisys.in/blog


Disclaimer : This email and any files transmitted with it are confidential
and intended solely for the use of the individual or entity to whom they
are addressed. If you have received this email in error please notify us.
This message contains confidential information and is intended only for the
individual named. If you are not the named addressee you should not
disseminate, distribute or copy this e-mail. Please notify the sender
immediately by e-mail if you have received this e-mail by mistake and
delete this e-mail from your system. If you are not the intended recipient
you are notified that disclosing, copying, distributing or taking any
action in reliance on the contents of this information is strictly
prohibited.',
                'received_date' => '2017-08-08 08:58:08',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-09 10:12:34',
                'updated_at' => '2018-10-15 06:49:41',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'cmpny_id' => 2,
                'email_id' => 10,
                'thread_id' => 5,
                'from' => 'akhil.murukan@orisys.in',
                'from_name' => 'Akhil Murukan <akhil.murukan@orisys.in>',
                'subject' => 'test email from akhil',
                'message' => 'chumma

On Tue, Aug 8, 2017 at 2:28 PM, Akhil Murukan <akhil.murukan@orisys.in>
wrote:

> hiiii
>
> On Tue, Aug 8, 2017 at 2:24 PM, Akhil Murukan <akhil.murukan@orisys.in>
> wrote:
>
>> hai,
>>
>> On Tue, Aug 8, 2017 at 1:05 PM, Akhil Murukan <akhil.murukan@orisys.in>
>> wrote:
>>
>>> fgfgsdgds
>>>
>>> On Tue, Aug 8, 2017 at 12:06 PM, Akhil Murukan <akhil.murukan@orisys.in>
>>> wrote:
>>>
>>>> haiiiiiiiiiii
>>>>
>>>> On Mon, Aug 7, 2017 at 2:42 PM, Akhil Murukan <akhil.murukan@orisys.in>
>>>> wrote:
>>>>
>>>>> hai
>>>>>
>>>>> On Mon, Aug 7, 2017 at 8:48 AM, Akhil Murukan <akhil.murukan@orisys.in
>>>>> > wrote:
>>>>>
>>>>>> Hi, Orisys
>>>>>> please find the attached document
>>>>>>
>>>>>> --
>>>>>> Regards,
>>>>>> *AKHIL MURUKAN*
>>>>>> Software Engineer
>>>>>>
>>>>>>
>>>>>> *  OrisysIndia Consultancy Services LLP​.​*
>>>>>> ​
>>>>>> "Driven by People, Technology & Values"
>>>>>> ​
>>>>>>
>>>>>> ​​
>>>>>> Floor (-
>>>>>> ​2​
>>>>>> ), Thejaswini, Technopark
>>>>>>     Thiruvananthapuram, Kerala, India, PIN 695 581
>>>>>>
>>>>>>
>>>>>> ​   Office ​
>>>>>> : +91
>>>>>> ​​04714015757
>>>>>> ​   Web
>>>>>> :
>>>>>> ​​
>>>>>> ​
>>>>>> www.orisys.in​
>>>>>>
>>>>>> ​   Blog  :​
>>>>>> ​www.orisys.in/blog
>>>>>>
>>>>>>
>>>>>> Disclaimer : This email and any files transmitted with it are
>>>>>> confidential and intended solely for the use of the individual or entity to
>>>>>> whom they are addressed. If you have received this email in error please
>>>>>> notify us. This message contains confidential information and is intended
>>>>>> only for the individual named. If you are not the named addressee you
>>>>>> should not disseminate, distribute or copy this e-mail. Please notify the
>>>>>> sender immediately by e-mail if you have received this e-mail by mistake
>>>>>> and delete this e-mail from your system. If you are not the intended
>>>>>> recipient you are notified that disclosing, copying, distributing or taking
>>>>>> any action in reliance on the contents of this information is strictly
>>>>>> prohibited.
>>>>>>
>>>>>>
>>>>>
>>>>>
>>>>> --
>>>>> Regards,
>>>>> *AKHIL MURUKAN*
>>>>> Software Engineer
>>>>>
>>>>>
>>>>> *  OrisysIndia Consultancy Services LLP​.​*
>>>>> ​
>>>>> "Driven by People, Technology & Values"
>>>>> ​
>>>>>
>>>>> ​​
>>>>> Floor (-
>>>>> ​2​
>>>>> ), Thejaswini, Technopark
>>>>>     Thiruvananthapuram, Kerala, India, PIN 695 581
>>>>>
>>>>>
>>>>> ​   Office ​
>>>>> : +91
>>>>> ​​04714015757
>>>>> ​   Web
>>>>> :
>>>>> ​​
>>>>> ​
>>>>> www.orisys.in​
>>>>>
>>>>> ​   Blog  :​
>>>>> ​www.orisys.in/blog
>>>>>
>>>>>
>>>>> Disclaimer : This email and any files transmitted with it are
>>>>> confidential and intended solely for the use of the individual or entity to
>>>>> whom they are addressed. If you have received this email in error please
>>>>> notify us. This message contains confidential information and is intended
>>>>> only for the individual named. If you are not the named addressee you
>>>>> should not disseminate, distribute or copy this e-mail. Please notify the
>>>>> sender immediately by e-mail if you have received this e-mail by mistake
>>>>> and delete this e-mail from your system. If you are not the intended
>>>>> recipient you are notified that disclosing, copying, distributing or taking
>>>>> any action in reliance on the contents of this information is strictly
>>>>> prohibited.
>>>>>
>>>>>
>>>>
>>>>
>>>> --
>>>> Regards,
>>>> *AKHIL MURUKAN*
>>>> Software Engineer
>>>>
>>>>
>>>> *  OrisysIndia Consultancy Services LLP​.​*
>>>> ​
>>>> "Driven by People, Technology & Values"
>>>> ​
>>>>
>>>> ​​
>>>> Floor (-
>>>> ​2​
>>>> ), Thejaswini, Technopark
>>>>     Thiruvananthapuram, Kerala, India, PIN 695 581
>>>>
>>>>
>>>> ​   Office ​
>>>> : +91
>>>> ​​04714015757
>>>> ​   Web
>>>> :
>>>> ​​
>>>> ​
>>>> www.orisys.in​
>>>>
>>>> ​   Blog  :​
>>>> ​www.orisys.in/blog
>>>>
>>>>
>>>> Disclaimer : This email and any files transmitted with it are
>>>> confidential and intended solely for the use of the individual or entity to
>>>> whom they are addressed. If you have received this email in error please
>>>> notify us. This message contains confidential information and is intended
>>>> only for the individual named. If you are not the named addressee you
>>>> should not disseminate, distribute or copy this e-mail. Please notify the
>>>> sender immediately by e-mail if you have received this e-mail by mistake
>>>> and delete this e-mail from your system. If you are not the intended
>>>> recipient you are notified that disclosing, copying, distributing or taking
>>>> any action in reliance on the contents of this information is strictly
>>>> prohibited.
>>>>
>>>>
>>>
>>>
>>> --
>>> Regards,
>>> *AKHIL MURUKAN*
>>> Software Engineer
>>>
>>>
>>> *  OrisysIndia Consultancy Services LLP​.​*
>>> ​
>>> "Driven by People, Technology & Values"
>>> ​
>>>
>>> ​​
>>> Floor (-
>>> ​2​
>>> ), Thejaswini, Technopark
>>>     Thiruvananthapuram, Kerala, India, PIN 695 581
>>>
>>>
>>> ​   Office ​
>>> : +91
>>> ​​04714015757
>>> ​   Web
>>> :
>>> ​​
>>> ​
>>> www.orisys.in​
>>>
>>> ​   Blog  :​
>>> ​www.orisys.in/blog
>>>
>>>
>>> Disclaimer : This email and any files transmitted with it are
>>> confidential and intended solely for the use of the individual or entity to
>>> whom they are addressed. If you have received this email in error please
>>> notify us. This message contains confidential information and is intended
>>> only for the individual named. If you are not the named addressee you
>>> should not disseminate, distribute or copy this e-mail. Please notify the
>>> sender immediately by e-mail if you have received this e-mail by mistake
>>> and delete this e-mail from your system. If you are not the intended
>>> recipient you are notified that disclosing, copying, distributing or taking
>>> any action in reliance on the contents of this information is strictly
>>> prohibited.
>>>
>>>
>>
>>
>> --
>> Regards,
>> *AKHIL MURUKAN*
>> Software Engineer
>>
>>
>> *  OrisysIndia Consultancy Services LLP​.​*
>> ​
>> "Driven by People, Technology & Values"
>> ​
>>
>> ​​
>> Floor (-
>> ​2​
>> ), Thejaswini, Technopark
>>     Thiruvananthapuram, Kerala, India, PIN 695 581
>>
>>
>> ​   Office ​
>> : +91
>> ​​04714015757
>> ​   Web
>> :
>> ​​
>> ​
>> www.orisys.in​
>>
>> ​   Blog  :​
>> ​www.orisys.in/blog
>>
>>
>> Disclaimer : This email and any files transmitted with it are
>> confidential and intended solely for the use of the individual or entity to
>> whom they are addressed. If you have received this email in error please
>> notify us. This message contains confidential information and is intended
>> only for the individual named. If you are not the named addressee you
>> should not disseminate, distribute or copy this e-mail. Please notify the
>> sender immediately by e-mail if you have received this e-mail by mistake
>> and delete this e-mail from your system. If you are not the intended
>> recipient you are notified that disclosing, copying, distributing or taking
>> any action in reliance on the contents of this information is strictly
>> prohibited.
>>
>>
>
>
> --
> Regards,
> *AKHIL MURUKAN*
> Software Engineer
>
>
> *  OrisysIndia Consultancy Services LLP​.​*
> ​
> "Driven by People, Technology & Values"
> ​
>
> ​​
> Floor (-
> ​2​
> ), Thejaswini, Technopark
>     Thiruvananthapuram, Kerala, India, PIN 695 581
>
>
> ​   Office ​
> : +91
> ​​04714015757
> ​   Web
> :
> ​​
> ​
> www.orisys.in​
>
> ​   Blog  :​
> ​www.orisys.in/blog
>
>
> Disclaimer : This email and any files transmitted with it are confidential
> and intended solely for the use of the individual or entity to whom they
> are addressed. If you have received this email in error please notify us.
> This message contains confidential information and is intended only for the
> individual named. If you are not the named addressee you should not
> disseminate, distribute or copy this e-mail. Please notify the sender
> immediately by e-mail if you have received this e-mail by mistake and
> delete this e-mail from your system. If you are not the intended recipient
> you are notified that disclosing, copying, distributing or taking any
> action in reliance on the contents of this information is strictly
> prohibited.
>
>


-- 
Regards,
*AKHIL MURUKAN*
Software Engineer


*  OrisysIndia Consultancy Services LLP​.​*
​
"Driven by People, Technology & Values"
​

​​
Floor (-
​2​
), Thejaswini, Technopark
Thiruvananthapuram, Kerala, India, PIN 695 581


​   Office ​
: +91
​​04714015757
​   Web
:
​​
​
www.orisys.in​

​   Blog  :​
​www.orisys.in/blog


Disclaimer : This email and any files transmitted with it are confidential
and intended solely for the use of the individual or entity to whom they
are addressed. If you have received this email in error please notify us.
This message contains confidential information and is intended only for the
individual named. If you are not the named addressee you should not
disseminate, distribute or copy this e-mail. Please notify the sender
immediately by e-mail if you have received this e-mail by mistake and
delete this e-mail from your system. If you are not the intended recipient
you are notified that disclosing, copying, distributing or taking any
action in reliance on the contents of this information is strictly
prohibited.',
                'received_date' => '2017-08-08 09:03:30',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-09 10:12:35',
                'updated_at' => '2018-10-15 06:49:41',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'cmpny_id' => 2,
                'email_id' => 11,
                'thread_id' => 11,
                'from' => 'arun.jaganathan@orisys.in',
                'from_name' => 'Arun Jaganathan <arun.jaganathan@orisys.in>',
                'subject' => 'test mail',
                'message' => 'Hi,
Please ignore this test mail....
Testing purpose please ignore;

-- 
*Thanks and Regards,*
*Arun Jaganathan*',
                'received_date' => '2017-08-08 09:11:52',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-09 10:12:38',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'cmpny_id' => 2,
                'email_id' => 12,
                'thread_id' => 12,
                'from' => 'chinnu.l@orisys.in',
                'from_name' => 'Chinnu L <chinnu.l@orisys.in>',
                'subject' => 'mail from chinnu',
                'message' => 'test testtesttesttesttesttesttesttesttesttesttest
-- 

Regards,


*​*Chinnu L

​
Team Lead-Web Team


*  OrisysIndia Consultancy Services LLP​.​*
​
"Driven by People, Technology & Values"
​

​​
Floor (-
​2​
), Thejaswini, Technopark
Thiruvananthapuram, Kerala, India, PIN 695 581
​   Mob   ​
:
​
​
+91 (0)
​9995381265

​   Office ​
: +91
​​04714015757
​   Web
:
​​
​
www.orisys.in​

​   Blog  :​
​www.orisys.in/blog


Disclaimer : This email and any files transmitted with it are confidential
and intended solely for the use of the individual or entity to whom they
are addressed. If you have received this email in error please notify us.
This message contains confidential information and is intended only for the
individual named. If you are not the named addressee you should not
disseminate, distribute or copy this e-mail. Please notify the sender
immediately by e-mail if you have received this e-mail by mistake and
delete this e-mail from your system. If you are not the intended recipient
you are notified that disclosing, copying, distributing or taking any
action in reliance on the contents of this information is strictly
prohibited.',
                'received_date' => '2017-08-08 09:44:52',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-09 10:12:39',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'cmpny_id' => 2,
                'email_id' => 13,
                'thread_id' => 13,
                'from' => 'chinnu.l@orisys.in',
                'from_name' => 'Chinnu L <chinnu.l@orisys.in>',
                'subject' => 'test mail from chinnu',
                'message' => 'Test mail Test mail Test mail Test mail Test mail Test mail Test mail Test
mail Test mail Test mail Test mail Test mail Test mail

-- 

Regards,',
                'received_date' => '2017-08-08 10:09:45',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-09 10:12:39',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 20,
                'cmpny_id' => 2,
                'email_id' => 17,
                'thread_id' => 17,
                'from' => 'devika.devarajan+3@orisys.in',
                'from_name' => 'Devika Devarajan <devika.devarajan@orisys.in>',
                'subject' => 'enquiry regarding payment of nri chity',
                'message' => 'Lorem Ipsum* is simply dummy text of the printing and typesetting industry.
Lorem Ipsum has been the industry\'s standard dummy text ever since the
1500s, when an unknown printer took a galley of type and scrambled it to
make a type specimen book. It has survived not only five centuries, but
also the leap into electronic typesetting, remaining essentially unchanged.
It was popularised in the 1960s with the release of Letras



Regards,


*Devika Devarajan*
Software Tester


*  OrisysIndia Consultancy Services LLP​.​*
​
"Driven by People, Technology & Values"
​

​​
Floor (-
​2​
), Thejaswini, Technopark
Thiruvananthapuram, Kerala, India, PIN 695 581


​   Office ​
: +91
​​04714015757
​   Web
:
​​
​
www.orisys.in​

​   Blog  :​
​www.orisys.in/blog


Disclaimer : This email and any files transmitted with it are confidential
and intended solely for the use of the individual or entity to whom they
are addressed. If you have received this email in error please notify us.
This message contains confidential information and is intended only for the
individual named. If you are not the named addressee you should not
disseminate, distribute or copy this e-mail. Please notify the sender
immediately by e-mail if you have received this e-mail by mistake and
delete this e-mail from your system. If you are not the intended recipient
you are notified that disclosing, copying, distributing or taking any
action in reliance on the contents of this information is strictly
prohibited.',
                'received_date' => '2017-08-10 11:17:44',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-10 11:18:00',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 21,
                'cmpny_id' => 2,
                'email_id' => 15,
                'thread_id' => 15,
                'from' => 'devika.devarajan+2@orisys.in',
                'from_name' => 'Devika Devarajan <devika.devarajan@orisys.in>',
                'subject' => 'enquiry regarding nri chitty',
                'message' => 'Hi,

*Lorem Ipsum* is simply dummy text of the printing and typesetting
industry. Lorem Ipsum has been the industry\'s standard dummy text ever
since the 1500s, when an unknown printer took a galley of type and
scrambled it to make a type specimen book.
It has survived not only five centuries, but also the leap into electronic
typesetting, remaining essentially unchanged. It was popularised in the
1960s with the release of Letraset sheets containing Lorem Ipsum passages,
and more recently with desktop publishing software like Aldus PageMaker
including versions of Lorem Ipsum.

Regards,


*Devika Devarajan*
Software Tester


*  OrisysIndia Consultancy Services LLP​.​*
​
"Driven by People, Technology & Values"
​

​​
Floor (-
​2​
), Thejaswini, Technopark
Thiruvananthapuram, Kerala, India, PIN 695 581


​   Office ​
: +91
​​04714015757
​   Web
:
​​
​
www.orisys.in​

​   Blog  :​
​www.orisys.in/blog


Disclaimer : This email and any files transmitted with it are confidential
and intended solely for the use of the individual or entity to whom they
are addressed. If you have received this email in error please notify us.
This message contains confidential information and is intended only for the
individual named. If you are not the named addressee you should not
disseminate, distribute or copy this e-mail. Please notify the sender
immediately by e-mail if you have received this e-mail by mistake and
delete this e-mail from your system. If you are not the intended recipient
you are notified that disclosing, copying, distributing or taking any
action in reliance on the contents of this information is strictly
prohibited.',
                'received_date' => '2017-08-10 10:53:57',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-10 11:48:17',
                'updated_at' => '2018-10-15 10:47:35',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 22,
                'cmpny_id' => 2,
                'email_id' => 16,
                'thread_id' => 15,
                'from' => 'devika.devarajan+1@orisys.in',
                'from_name' => 'Devika Devarajan <devika.devarajan@orisys.in>',
                'subject' => 'enquiry regarding nri chitty',
                'message' => 'HI,


ഒരു ചിട്ടി ഒരു വ്യക്തിയോ സ്ഥാപനമോ ആണ് നടത്തുന്നത്. ഈ സ്ഥാപനത്തെ ഫോർമാൻ
എന്നു വിളിക്കുന്നു.


Regards,


*Devika Devarajan*
Software Tester


*  OrisysIndia Consultancy Services LLP​.​*
​
"Driven by People, Technology & Values"
​

​​
Floor (-
​2​
), Thejaswini, Technopark
Thiruvananthapuram, Kerala, India, PIN 695 581


​   Office ​
: +91
​​04714015757
​   Web
:
​​
​
www.orisys.in​

​   Blog  :​
​www.orisys.in/blog


Disclaimer : This email and any files transmitted with it are confidential
and intended solely for the use of the individual or entity to whom they
are addressed. If you have received this email in error please notify us.
This message contains confidential information and is intended only for the
individual named. If you are not the named addressee you should not
disseminate, distribute or copy this e-mail. Please notify the sender
immediately by e-mail if you have received this e-mail by mistake and
delete this e-mail from your system. If you are not the intended recipient
you are notified that disclosing, copying, distributing or taking any
action in reliance on the contents of this information is strictly
prohibited.


On 10 August 2017 at 16:23, Devika Devarajan <devika.devarajan@orisys.in>
wrote:

> Hi,
>
> *Lorem Ipsum* is simply dummy text of the printing and typesetting
> industry. Lorem Ipsum has been the industry\'s standard dummy text ever
> since the 1500s, when an unknown printer took a galley of type and
> scrambled it to make a type specimen book.
> It has survived not only five centuries, but also the leap into electronic
> typesetting, remaining essentially unchanged. It was popularised in the
> 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
> and more recently with desktop publishing software like Aldus PageMaker
> including versions of Lorem Ipsum.
>
> Regards,
>
>
> *Devika Devarajan*
> Software Tester
>
>
> *  OrisysIndia Consultancy Services LLP​.​*
> ​
> "Driven by People, Technology & Values"
> ​
>
> ​​
> Floor (-
> ​2​
> ), Thejaswini, Technopark
>     Thiruvananthapuram, Kerala, India, PIN 695 581
>
>
> ​   Office ​
> : +91
> ​​04714015757
> ​   Web
> :
> ​​
> ​
> www.orisys.in​
>
> ​   Blog  :​
> ​www.orisys.in/blog
>
>
> Disclaimer : This email and any files transmitted with it are confidential
> and intended solely for the use of the individual or entity to whom they
> are addressed. If you have received this email in error please notify us.
> This message contains confidential information and is intended only for the
> individual named. If you are not the named addressee you should not
> disseminate, distribute or copy this e-mail. Please notify the sender
> immediately by e-mail if you have received this e-mail by mistake and
> delete this e-mail from your system. If you are not the intended recipient
> you are notified that disclosing, copying, distributing or taking any
> action in reliance on the contents of this information is strictly
> prohibited.
>
>',
                'received_date' => '2017-08-10 11:04:57',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-10 11:48:18',
                'updated_at' => '2018-10-15 10:47:35',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 23,
                'cmpny_id' => 2,
                'email_id' => 14,
                'thread_id' => 12,
                'from' => 'chinnu.l@orisys.in',
                'from_name' => 'Chinnu L <chinnu.l@orisys.in>',
                'subject' => 'mail from chinnu',
                'message' => 'sdffffffff

On Tue, Aug 8, 2017 at 3:14 PM, Chinnu L <chinnu.l@orisys.in> wrote:

>
> test testtesttesttesttesttesttesttesttesttesttest
> --
>
> Regards,
>
>
> *​*Chinnu L
>
> ​
> Team Lead-Web Team
>
>
> *  OrisysIndia Consultancy Services LLP​.​*
> ​
> "Driven by People, Technology & Values"
> ​
>
> ​​
> Floor (-
> ​2​
> ), Thejaswini, Technopark
>     Thiruvananthapuram, Kerala, India, PIN 695 581
> ​   Mob   ​
> :
> ​
> ​
> +91 (0)
> ​9995381265
>
> ​   Office ​
> : +91
> ​​04714015757
> ​   Web
> :
> ​​
> ​
> www.orisys.in​
>
> ​   Blog  :​
> ​www.orisys.in/blog
>
>
> Disclaimer : This email and any files transmitted with it are confidential
> and intended solely for the use of the individual or entity to whom they
> are addressed. If you have received this email in error please notify us.
> This message contains confidential information and is intended only for the
> individual named. If you are not the named addressee you should not
> disseminate, distribute or copy this e-mail. Please notify the sender
> immediately by e-mail if you have received this e-mail by mistake and
> delete this e-mail from your system. If you are not the intended recipient
> you are notified that disclosing, copying, distributing or taking any
> action in reliance on the contents of this information is strictly
> prohibited.
>



-- 

Regards,


*​*Chinnu L

​
Team Lead-Web Team


*  OrisysIndia Consultancy Services LLP​.​*
​
"Driven by People, Technology & Values"
​

​​
Floor (-
​2​
), Thejaswini, Technopark
Thiruvananthapuram, Kerala, India, PIN 695 581
​   Mob   ​
:
​
​
+91 (0)
​9995381265

​   Office ​
: +91
​​04714015757
​   Web
:
​​
​
www.orisys.in​

​   Blog  :​
​www.orisys.in/blog


Disclaimer : This email and any files transmitted with it are confidential
and intended solely for the use of the individual or entity to whom they
are addressed. If you have received this email in error please notify us.
This message contains confidential information and is intended only for the
individual named. If you are not the named addressee you should not
disseminate, distribute or copy this e-mail. Please notify the sender
immediately by e-mail if you have received this e-mail by mistake and
delete this e-mail from your system. If you are not the intended recipient
you are notified that disclosing, copying, distributing or taking any
action in reliance on the contents of this information is strictly
prohibited.',
                'received_date' => '2017-08-09 06:58:54',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-10 11:58:24',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 24,
                'cmpny_id' => 2,
                'email_id' => 18,
                'thread_id' => 18,
                'from' => 'devika.devarajan@orisys.in',
                'from_name' => 'Devika Devarajan <devika.devarajan@orisys.in>',
                'subject' => 'Testing email fetch',
                'message' => '*Lorem Ipsum* is simply dummy text of the printing and typesetting
industry. Lorem Ipsum has been the industry\'s standard dummy text ever
since the 1500s, when an unknown printer took a galley of type and
scrambled it to make a type specimen book. It has survived not only five
centuries,

Regards,


*Devika Devarajan*
Software Tester


*  OrisysIndia Consultancy Services LLP​.​*
​
"Driven by People, Technology & Values"
​

​​
Floor (-
​2​
), Thejaswini, Technopark
Thiruvananthapuram, Kerala, India, PIN 695 581


​   Office ​
: +91
​​04714015757
​   Web
:
​​
​
www.orisys.in​

​   Blog  :​
​www.orisys.in/blog


Disclaimer : This email and any files transmitted with it are confidential
and intended solely for the use of the individual or entity to whom they
are addressed. If you have received this email in error please notify us.
This message contains confidential information and is intended only for the
individual named. If you are not the named addressee you should not
disseminate, distribute or copy this e-mail. Please notify the sender
immediately by e-mail if you have received this e-mail by mistake and
delete this e-mail from your system. If you are not the intended recipient
you are notified that disclosing, copying, distributing or taking any
action in reliance on the contents of this information is strictly
prohibited.',
                'received_date' => '2017-08-23 10:49:04',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-23 10:49:50',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 25,
                'cmpny_id' => 2,
                'email_id' => 19,
                'thread_id' => 18,
                'from' => 'devika.devarajan@orisys.in',
                'from_name' => 'Devika Devarajan <devika.devarajan@orisys.in>',
                'subject' => 'Testing email fetch',
                'message' => 'Testing

Regards,


*Devika Devarajan*
Software Tester


*  OrisysIndia Consultancy Services LLP​.​*
​
"Driven by People, Technology & Values"
​

​​
Floor (-
​2​
), Thejaswini, Technopark
Thiruvananthapuram, Kerala, India, PIN 695 581


​   Office ​
: +91
​​04714015757
​   Web
:
​​
​
www.orisys.in​

​   Blog  :​
​www.orisys.in/blog


Disclaimer : This email and any files transmitted with it are confidential
and intended solely for the use of the individual or entity to whom they
are addressed. If you have received this email in error please notify us.
This message contains confidential information and is intended only for the
individual named. If you are not the named addressee you should not
disseminate, distribute or copy this e-mail. Please notify the sender
immediately by e-mail if you have received this e-mail by mistake and
delete this e-mail from your system. If you are not the intended recipient
you are notified that disclosing, copying, distributing or taking any
action in reliance on the contents of this information is strictly
prohibited.


On 23 August 2017 at 10:48, Devika Devarajan <devika.devarajan@orisys.in>
wrote:

> *Lorem Ipsum* is simply dummy text of the printing and typesetting
> industry. Lorem Ipsum has been the industry\'s standard dummy text ever
> since the 1500s, when an unknown printer took a galley of type and
> scrambled it to make a type specimen book. It has survived not only five
> centuries,
>
> Regards,
>
>
> *Devika Devarajan*
> Software Tester
>
>
> *  OrisysIndia Consultancy Services LLP​.​*
> ​
> "Driven by People, Technology & Values"
> ​
>
> ​​
> Floor (-
> ​2​
> ), Thejaswini, Technopark
>     Thiruvananthapuram, Kerala, India, PIN 695 581
>
>
> ​   Office ​
> : +91
> ​​04714015757
> ​   Web
> :
> ​​
> ​
> www.orisys.in​
>
> ​   Blog  :​
> ​www.orisys.in/blog
>
>
> Disclaimer : This email and any files transmitted with it are confidential
> and intended solely for the use of the individual or entity to whom they
> are addressed. If you have received this email in error please notify us.
> This message contains confidential information and is intended only for the
> individual named. If you are not the named addressee you should not
> disseminate, distribute or copy this e-mail. Please notify the sender
> immediately by e-mail if you have received this e-mail by mistake and
> delete this e-mail from your system. If you are not the intended recipient
> you are notified that disclosing, copying, distributing or taking any
> action in reliance on the contents of this information is strictly
> prohibited.
>
>',
                'received_date' => '2017-08-23 10:58:33',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-23 10:58:38',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 26,
                'cmpny_id' => 2,
                'email_id' => 20,
                'thread_id' => 20,
                'from' => 'devika.devarajan@orisys.in',
                'from_name' => 'Devika Devarajan <devika.devarajan@orisys.in>',
                'subject' => 'enquiry regarding NRI chit availble',
                'message' => 'It is a long established fact that a reader will be distracted by the
readable content of a page when looking at its layout. The point of using
Lorem Ipsum is that it has a more-or-less normal distribution of letters,
as opposed to using \'Content here, content here\', making it look like
readable English. Many desktop publishing packages and web page editors now
use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\'
will uncover many web sites still in their infancy. Various versions have
evolved over the years, sometimes by accident, sometimes on purpose
(injected humour and the like).



Regards,


*Devika Devarajan*
Software Tester


*  OrisysIndia Consultancy Services LLP​.​*
​
"Driven by People, Technology & Values"
​

​​
Floor (-
​2​
), Thejaswini, Technopark
Thiruvananthapuram, Kerala, India, PIN 695 581


​   Office ​
: +91
​​04714015757
​   Web
:
​​
​
www.orisys.in​

​   Blog  :​
​www.orisys.in/blog


Disclaimer : This email and any files transmitted with it are confidential
and intended solely for the use of the individual or entity to whom they
are addressed. If you have received this email in error please notify us.
This message contains confidential information and is intended only for the
individual named. If you are not the named addressee you should not
disseminate, distribute or copy this e-mail. Please notify the sender
immediately by e-mail if you have received this e-mail by mistake and
delete this e-mail from your system. If you are not the intended recipient
you are notified that disclosing, copying, distributing or taking any
action in reliance on the contents of this information is strictly
prohibited.',
                'received_date' => '2017-08-23 11:00:31',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-23 11:01:05',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 27,
                'cmpny_id' => 2,
                'email_id' => 21,
                'thread_id' => 20,
                'from' => 'devika.devarajan@orisys.in',
                'from_name' => 'Devika Devarajan <devika.devarajan@orisys.in>',
                'subject' => 'enquiry regarding NRI chit availble',
                'message' => 'dfhfdh

Regards,


*Devika Devarajan*
Software Tester


*  OrisysIndia Consultancy Services LLP​.​*
​
"Driven by People, Technology & Values"
​

​​
Floor (-
​2​
), Thejaswini, Technopark
Thiruvananthapuram, Kerala, India, PIN 695 581


​   Office ​
: +91
​​04714015757
​   Web
:
​​
​
www.orisys.in​

​   Blog  :​
​www.orisys.in/blog


Disclaimer : This email and any files transmitted with it are confidential
and intended solely for the use of the individual or entity to whom they
are addressed. If you have received this email in error please notify us.
This message contains confidential information and is intended only for the
individual named. If you are not the named addressee you should not
disseminate, distribute or copy this e-mail. Please notify the sender
immediately by e-mail if you have received this e-mail by mistake and
delete this e-mail from your system. If you are not the intended recipient
you are notified that disclosing, copying, distributing or taking any
action in reliance on the contents of this information is strictly
prohibited.


On 23 August 2017 at 11:00, Devika Devarajan <devika.devarajan@orisys.in>
wrote:

> It is a long established fact that a reader will be distracted by the
> readable content of a page when looking at its layout. The point of using
> Lorem Ipsum is that it has a more-or-less normal distribution of letters,
> as opposed to using \'Content here, content here\', making it look like
> readable English. Many desktop publishing packages and web page editors now
> use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\'
> will uncover many web sites still in their infancy. Various versions have
> evolved over the years, sometimes by accident, sometimes on purpose
> (injected humour and the like).
>
>
>
> Regards,
>
>
> *Devika Devarajan*
> Software Tester
>
>
> *  OrisysIndia Consultancy Services LLP​.​*
> ​
> "Driven by People, Technology & Values"
> ​
>
> ​​
> Floor (-
> ​2​
> ), Thejaswini, Technopark
>     Thiruvananthapuram, Kerala, India, PIN 695 581
>
>
> ​   Office ​
> : +91
> ​​04714015757
> ​   Web
> :
> ​​
> ​
> www.orisys.in​
>
> ​   Blog  :​
> ​www.orisys.in/blog
>
>
> Disclaimer : This email and any files transmitted with it are confidential
> and intended solely for the use of the individual or entity to whom they
> are addressed. If you have received this email in error please notify us.
> This message contains confidential information and is intended only for the
> individual named. If you are not the named addressee you should not
> disseminate, distribute or copy this e-mail. Please notify the sender
> immediately by e-mail if you have received this e-mail by mistake and
> delete this e-mail from your system. If you are not the intended recipient
> you are notified that disclosing, copying, distributing or taking any
> action in reliance on the contents of this information is strictly
> prohibited.
>
>',
                'received_date' => '2017-08-23 11:02:29',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-23 11:05:36',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 28,
                'cmpny_id' => 2,
                'email_id' => 22,
                'thread_id' => 22,
                'from' => 'devika.devarajan@orisys.in',
                'from_name' => 'Devika Devarajan <devika.devarajan@orisys.in>',
                'subject' => 'test1',
                'message' => 'sdgsgf

Regards,


*Devika Devarajan*
Software Tester


*  OrisysIndia Consultancy Services LLP​.​*
​
"Driven by People, Technology & Values"
​

​​
Floor (-
​2​
), Thejaswini, Technopark
Thiruvananthapuram, Kerala, India, PIN 695 581


​   Office ​
: +91
​​04714015757
​   Web
:
​​
​
www.orisys.in​

​   Blog  :​
​www.orisys.in/blog


Disclaimer : This email and any files transmitted with it are confidential
and intended solely for the use of the individual or entity to whom they
are addressed. If you have received this email in error please notify us.
This message contains confidential information and is intended only for the
individual named. If you are not the named addressee you should not
disseminate, distribute or copy this e-mail. Please notify the sender
immediately by e-mail if you have received this e-mail by mistake and
delete this e-mail from your system. If you are not the intended recipient
you are notified that disclosing, copying, distributing or taking any
action in reliance on the contents of this information is strictly
prohibited.',
                'received_date' => '2017-08-23 11:02:43',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-23 11:05:37',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 29,
                'cmpny_id' => 2,
                'email_id' => 23,
                'thread_id' => 23,
                'from' => 'devika.devarajan@orisys.in',
                'from_name' => 'Devika Devarajan <devika.devarajan@orisys.in>',
                'subject' => 'testing attachments',
            'message' => '<div dir="ltr"><div class="gmail_default" style="font-family:verdana,sans-serif">testing attachments</div><div class="gmail_default" style="font-family:verdana,sans-serif"><br></div><div class="gmail_default" style="font-family:verdana,sans-serif"><br></div><div><div class="gmail_signature" data-smartmail="gmail_signature"><div dir="ltr"><div><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)"><tbody><tr><td><span style="padding:0px;margin:0px;font-size:10pt">Regards,<br><br></span></td></tr><tr><td style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:rgb(184,32,37)"></td></tr><tr><td></td></tr><tr><td></td></tr></tbody></table><br><div style="font-size:12.8000001907349px"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="color:rgb(50,50,50);font-family:Arial,Helvetica,sans-serif;font-size:8pt;line-height:9pt"><tbody><tr><td><font face="verdana, sans-serif"><span style="font-size:13.3333330154419px"><b>Devika Devarajan</b></span></font><span style="color:rgb(112,113,115);font-family:verdana,sans-serif;font-size:12px"><br>Software Tester<br></span><table border="0" cellpadding="0" cellspacing="0" width="172" style="border-collapse:collapse;width:129pt"><tbody><tr height="20" style="height:15.0pt">
<td height="20" width="108" style="height:15.0pt;width:81pt"><img src="http://orisys.in/orisys_logo.png"><br></td>
<td width="64" style="width:48pt"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="line-height:9pt;font-family:Arial,Helvetica,sans-serif;font-size:8pt;white-space:nowrap"><tbody><tr><td><span style="font-family:Arial,Helvetica,sans-serif;font-size:10pt"><b><div style="font-family:verdana,sans-serif;display:inline">  OrisysIndia Consultancy Services LLP​</div>.<br><div style="font-family:verdana,sans-serif;display:inline">​</div></b></span><span style="font-family:verdana,sans-serif;line-height:normal;white-space:normal"><div style="font-size:small;font-weight:bold;color:rgb(204,0,0);display:inline">​  </div><font color="#000000" size="1">&quot;Driven by People, Technology &amp; Values&quot; </font></span><span style="font-family:Arial,Helvetica,sans-serif;line-height:9pt"><div style="font-family:verdana,sans-serif;display:inline"><font color="#000000" size="1">​</font></div></span><span style="font-family:Arial,Helvetica,sans-serif;font-size:10pt"><b><div style="font-family:verdana,sans-serif;display:inline"><br></div></b></span></td></tr><tr><td><div style="font-family:verdana,sans-serif;display:inline">​​   </div>Floor (-<div style="font-family:verdana,sans-serif;display:inline">​2​</div>), Thejaswini, Technopark</td></tr><tr><td>    Thiruvananthapuram, Kerala, India, PIN 695 581</td></tr></tbody></table><br style="font-family:Arial,Helvetica,sans-serif;font-size:10.6666669845581px;white-space:nowrap;line-height:4pt"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;font-size:8pt;white-space:nowrap;line-height:10pt"><tbody><tr><td width="35"><br></td><td><div style="font-family:verdana,sans-serif;display:inline"><br></div></td></tr><tr><td><div style="font-family:verdana,sans-serif;display:inline">​   Office ​</div>:</td><td>+91  <div style="font-family:verdana,sans-serif;display:inline">​<span style="font-size:10.6666669845581px;line-height:13.3333330154419px">​04714015757</span><br></div></td></tr><tr><td><div style="font-family:verdana,sans-serif;display:inline">​   Web   </div>:</td><td><div style="font-family:verdana,sans-serif;display:inline">​​</div><div style="font-family:verdana,sans-serif;display:inline">​</div><span style="font-family:verdana,sans-serif;font-size:10.6666669845581px;line-height:13.3333330154419px"><a href="http://www.orisys.in/" style="color:rgb(17,85,204)" target="_blank">www.orisys.in</a>​</span></td></tr><tr><td><div style="font-family:verdana,sans-serif;display:inline">​   Blog  :​</div></td><td><div style="font-family:verdana,sans-serif;display:inline">​<a href="http://www.orisys.in/blog" style="color:rgb(17,85,204)" target="_blank">www.orisys.in/blog</a></div></td></tr></tbody></table></td></tr></tbody></table><div style="color:rgb(34,34,34);font-size:12.8000001907349px;line-height:normal"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)"><tbody><tr><td style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:rgb(200,200,200)"><br></td></tr></tbody></table></div><div style="color:rgb(34,34,34);font-size:12.8000001907349px;line-height:normal"><div style="font-family:verdana,sans-serif"><div> <br></div><font color="#666666" style="font-size:x-small"><div style="text-align:center"><span style="font-size:small"></span></div></font><font color="#666666" style="font-size:x-small"><div style="text-align:center"><div style="text-align:left">Disclaimer : This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify us. This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</div></div></font></div></div></td></tr><tr><td><br></td></tr></tbody></table></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>
</div>',
                'received_date' => '2017-08-23 11:38:24',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-23 11:38:42',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 30,
                'cmpny_id' => 2,
                'email_id' => 0,
                'thread_id' => 12,
                'from' => 'oriesmarti@gmail.com',
                'from_name' => 'KSFE',
                'subject' => 'mail from chinnu',
                'message' => 'test mail',
                'received_date' => '2017-08-23 15:18:07',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-23 15:18:07',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 31,
                'cmpny_id' => 2,
                'email_id' => 0,
                'thread_id' => 12,
                'from' => 'oriesmarti@gmail.com',
                'from_name' => 'KSFE <oriesmarti@gmail.com>',
                'subject' => 'mail from chinnu',
                'message' => 'test test',
                'received_date' => '2017-08-23 16:31:48',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-23 16:31:48',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 32,
                'cmpny_id' => 2,
                'email_id' => 0,
                'thread_id' => 12,
                'from' => 'oriesmarti@gmail.com',
                'from_name' => 'KSFE <oriesmarti@gmail.com>',
                'subject' => 'mail from chinnu',
                'message' => 'testttt',
                'received_date' => '2017-08-23 18:07:00',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-23 18:07:00',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 33,
                'cmpny_id' => 2,
                'email_id' => 0,
                'thread_id' => 5,
                'from' => 'oriesmarti@gmail.com',
                'from_name' => 'KSFE <oriesmarti@gmail.com>',
                'subject' => 'test email from akhil',
                'message' => 'hhhiiiiiiii',
                'received_date' => '2017-08-23 18:18:26',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-23 18:18:26',
                'updated_at' => '2018-10-15 06:49:41',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 34,
                'cmpny_id' => 2,
                'email_id' => 0,
                'thread_id' => 5,
                'from' => 'oriesmarti@gmail.com',
                'from_name' => 'KSFE <oriesmarti@gmail.com>',
                'subject' => 'test email from akhil',
                'message' => 'hhhiiiiiiii',
                'received_date' => '2017-08-23 18:18:30',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-23 18:18:30',
                'updated_at' => '2018-10-15 06:49:41',
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 35,
                'cmpny_id' => 2,
                'email_id' => 0,
                'thread_id' => 5,
                'from' => 'oriesmarti@gmail.com',
                'from_name' => 'KSFE <oriesmarti@gmail.com>',
                'subject' => 'test email from akhil',
                'message' => 'hhhiiiiiiii',
                'received_date' => '2017-08-23 18:18:30',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-23 18:18:30',
                'updated_at' => '2018-10-15 06:49:41',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 36,
                'cmpny_id' => 2,
                'email_id' => 24,
                'thread_id' => 24,
                'from' => 'devika.devarajan@orisys.in',
                'from_name' => 'Devika Devarajan <devika.devarajan@orisys.in>',
                'subject' => 'testing email fetching',
            'message' => '<div dir="ltr"><div class="gmail_default" style="font-family:verdana,sans-serif">Hi,</div><div class="gmail_default" style="font-family:verdana,sans-serif"><br></div><div class="gmail_default" style="font-family:verdana,sans-serif"><strong style="margin:0px;padding:0px;color:rgb(0,0,0);font-family:&quot;Open Sans&quot;,Arial,sans-serif;font-size:14px;text-align:justify">Lorem Ipsum</strong><span style="color:rgb(0,0,0);font-family:&quot;Open Sans&quot;,Arial,sans-serif;font-size:14px;text-align:justify"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></div><div class="gmail_default" style="font-family:verdana,sans-serif"><span style="color:rgb(0,0,0);font-family:&quot;Open Sans&quot;,Arial,sans-serif;font-size:14px;text-align:justify"><br></span></div><div><div class="gmail_signature"><div dir="ltr"><div><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)"><tbody><tr><td><span style="padding:0px;margin:0px;font-size:10pt">Regards,<br><br></span></td></tr><tr><td style="border-bottom:1px solid rgb(184,32,37)"></td></tr><tr><td></td></tr><tr><td></td></tr></tbody></table><br><div style="font-size:12.8px"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="color:rgb(50,50,50);font-family:Arial,Helvetica,sans-serif;font-size:8pt;line-height:9pt"><tbody><tr><td><font face="verdana, sans-serif"><span style="font-size:13.3333px"><b>Devika Devarajan</b></span></font><span style="color:rgb(112,113,115);font-family:verdana,sans-serif;font-size:12px"><br>Software Tester<br></span><table border="0" cellpadding="0" cellspacing="0" width="172" style="border-collapse:collapse;width:129pt"><tbody><tr height="20" style="height:15pt">
<td height="20" width="108" style="height:15pt;width:81pt"><img src="http://orisys.in/orisys_logo.png"><br></td>
<td width="64" style="width:48pt"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="line-height:9pt;font-family:Arial,Helvetica,sans-serif;font-size:8pt;white-space:nowrap"><tbody><tr><td><span style="font-family:Arial,Helvetica,sans-serif;font-size:10pt"><b><div style="font-family:verdana,sans-serif;display:inline">  OrisysIndia Consultancy Services LLP​</div>.<br><div style="font-family:verdana,sans-serif;display:inline">​</div></b></span><span style="font-family:verdana,sans-serif;line-height:normal;white-space:normal"><div style="font-size:small;font-weight:bold;color:rgb(204,0,0);display:inline">​  </div><font color="#000000" size="1">&quot;Driven by People, Technology &amp; Values&quot; </font></span><span style="font-family:Arial,Helvetica,sans-serif;line-height:9pt"><div style="font-family:verdana,sans-serif;display:inline"><font color="#000000" size="1">​</font></div></span><span style="font-family:Arial,Helvetica,sans-serif;font-size:10pt"><b><div style="font-family:verdana,sans-serif;display:inline"><br></div></b></span></td></tr><tr><td><div style="font-family:verdana,sans-serif;display:inline">​​   </div>Floor (-<div style="font-family:verdana,sans-serif;display:inline">​2​</div>), Thejaswini, Technopark</td></tr><tr><td>    Thiruvananthapuram, Kerala, India, PIN 695 581</td></tr></tbody></table><br style="font-family:Arial,Helvetica,sans-serif;font-size:10.6667px;white-space:nowrap;line-height:4pt"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;font-size:8pt;white-space:nowrap;line-height:10pt"><tbody><tr><td width="35"><br></td><td><div style="font-family:verdana,sans-serif;display:inline"><br></div></td></tr><tr><td><div style="font-family:verdana,sans-serif;display:inline">​   Office ​</div>:</td><td>+91  <div style="font-family:verdana,sans-serif;display:inline">​<span style="font-size:10.6667px;line-height:13.3333px">​04714015757</span><br></div></td></tr><tr><td><div style="font-family:verdana,sans-serif;display:inline">​   Web   </div>:</td><td><div style="font-family:verdana,sans-serif;display:inline">​​</div><div style="font-family:verdana,sans-serif;display:inline">​</div><span style="font-family:verdana,sans-serif;font-size:10.6667px;line-height:13.3333px"><a href="http://www.orisys.in/" style="color:rgb(17,85,204)" target="_blank">www.orisys.in</a>​</span></td></tr><tr><td><div style="font-family:verdana,sans-serif;display:inline">​   Blog  :​</div></td><td><div style="font-family:verdana,sans-serif;display:inline">​<a href="http://www.orisys.in/blog" style="color:rgb(17,85,204)" target="_blank">www.orisys.in/blog</a></div></td></tr></tbody></table></td></tr></tbody></table><div style="color:rgb(34,34,34);font-size:12.8px;line-height:normal"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)"><tbody><tr><td style="border-bottom:1px solid rgb(200,200,200)"><br></td></tr></tbody></table></div><div style="color:rgb(34,34,34);font-size:12.8px;line-height:normal"><div style="font-family:verdana,sans-serif"><div> <br></div><font color="#666666" style="font-size:x-small"><div style="text-align:center"><span style="font-size:small"></span></div></font><font color="#666666" style="font-size:x-small"><div style="text-align:center"><div style="text-align:left">Disclaimer : This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify us. This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</div></div></font></div></div></td></tr><tr><td><br></td></tr></tbody></table></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>
</div>',
                'received_date' => '2017-08-25 12:50:27',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-25 12:51:09',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 37,
                'cmpny_id' => 2,
                'email_id' => 0,
                'thread_id' => 24,
                'from' => 'oriesmarti@gmail.com',
                'from_name' => 'KSFE <oriesmarti@gmail.com>',
                'subject' => 'testing email fetching',
                'message' => 'hi recieved your enquiry. please send your basic details including phone number to register',
                'received_date' => '2017-08-25 12:52:19',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-25 12:52:19',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 38,
                'cmpny_id' => 2,
                'email_id' => 25,
                'thread_id' => 24,
                'from' => 'devika.devarajan@orisys.in',
                'from_name' => 'Devika Devarajan <devika.devarajan@orisys.in>',
                'subject' => 'testing email fetching',
                'message' => 'hai,

Name : Devika Devarajan , Phone num : 9946364521 ,
Anjilimoottil house , palackathakidi P o , kunnamthanam

Regards,


*Devika Devarajan*
Software Tester


*  OrisysIndia Consultancy Services LLP​.​*
​
"Driven by People, Technology & Values"
​

​​
Floor (-
​2​
), Thejaswini, Technopark
Thiruvananthapuram, Kerala, India, PIN 695 581


​   Office ​
: +91
​​04714015757
​   Web
:
​​
​
www.orisys.in​

​   Blog  :​
​www.orisys.in/blog


Disclaimer : This email and any files transmitted with it are confidential
and intended solely for the use of the individual or entity to whom they
are addressed. If you have received this email in error please notify us.
This message contains confidential information and is intended only for the
individual named. If you are not the named addressee you should not
disseminate, distribute or copy this e-mail. Please notify the sender
immediately by e-mail if you have received this e-mail by mistake and
delete this e-mail from your system. If you are not the intended recipient
you are notified that disclosing, copying, distributing or taking any
action in reliance on the contents of this information is strictly
prohibited.


On 25 August 2017 at 12:52, KSFE <oriesmarti@gmail.com> wrote:

> hi recieved your enquiry. please send your basic details including phone
> number to register
>
> --
>
> Best Regards
> ------------------------------
> © 2017 | All Rights Reserved.
> test@gmail.com | www.ksfe.com
>',
                'received_date' => '2017-08-25 12:56:13',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-25 12:56:57',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 39,
                'cmpny_id' => 2,
                'email_id' => 0,
                'thread_id' => 24,
                'from' => 'oriesmarti@gmail.com',
                'from_name' => 'KSFE <oriesmarti@gmail.com>',
                'subject' => 'testing email fetching',
                'message' => 'ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ് ചിറ്റ്',
                'received_date' => '2017-08-25 13:02:37',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-25 13:02:37',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 40,
                'cmpny_id' => 2,
                'email_id' => 0,
                'thread_id' => 24,
                'from' => 'oriesmarti@gmail.com',
                'from_name' => 'KSFE <oriesmarti@gmail.com>',
                'subject' => 'testing email fetching',
                'message' => 'dsfdsf',
                'received_date' => '2017-08-25 13:06:45',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-25 13:06:45',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 41,
                'cmpny_id' => 2,
                'email_id' => 30,
                'thread_id' => 30,
                'from' => 'arun.raj@orisys.in',
                'from_name' => 'Arun Raj <arun.raj@orisys.in>',
            'subject' => 'Invitation: FRaise App Discussion @ Thu Sep 21, 2017 3pm - 3:30pm (Arun Raj)',
            'message' => '<div dir="ltr"><div class="gmail_default" style="font-family:verdana,sans-serif"><br></div><div class="gmail_quote">---------- Forwarded message ----------<br>From: <b class="gmail_sendername">Amruth Raj R</b> <span dir="ltr">&lt;<a href="mailto:amruth.raj@orisys.in">amruth.raj@orisys.in</a>&gt;</span><br>Date: Wed, Sep 20, 2017 at 9:30 PM<br>Subject: Invitation: FRaise App Discussion @ Thu Sep 21, 2017 3pm - 3:30pm (Arun Raj)<br>To: <a href="mailto:arun.raj@orisys.in">arun.raj@orisys.in</a>, Binny V A &lt;<a href="mailto:binnyva@makeadiff.in">binnyva@makeadiff.in</a>&gt;, <a href="mailto:anand.a@orisys.in">anand.a@orisys.in</a>, <a href="mailto:rejeesh.nair@orisys.in">rejeesh.nair@orisys.in</a>, Jithin Nedumala &lt;<a href="mailto:jithin@makeadiff.in">jithin@makeadiff.in</a>&gt;, Rajesh Balan &lt;<a href="mailto:rajesh.balan@orisys.in">rajesh.balan@orisys.in</a>&gt;, <a href="mailto:nishant@makeadiff.in">nishant@makeadiff.in</a><br><br><br><span><span style="display:none"></span><span><div><table cellspacing="0" cellpadding="8" border="0" summary="" style="width:100%;font-family:Arial,Sans-serif;border:1px Solid #ccc;border-width:1px 2px 2px 1px;background-color:#fff"><tbody><tr><td><div style="padding:2px"><span></span><div style="float:right;font-weight:bold;font-size:13px"> <a href="https://www.google.com/calendar/event?action=VIEW&amp;eid=MGozbDByMXYxcXNqY2FocjNodXQ3ZWsxOGogYXJ1bi5yYWpAb3Jpc3lzLmlu&amp;tok=MjAjYW1ydXRoLnJhakBvcmlzeXMuaW5hNDI3YjQ4MjJlN2M4OTJkMmY1ZjIxNGNjNGE4MWFlOTgzODQ0MDZh&amp;ctz=Asia/Calcutta&amp;hl=en" style="color:#20c;white-space:nowrap" target="_blank">more details »</a><br></div><h3 style="padding:0 0 6px 0;margin:0;font-family:Arial,Sans-serif;font-size:16px;font-weight:bold;color:#222"><span>FRaise App Discussion</span></h3><table cellpadding="0" cellspacing="0" border="0" summary="Event details"><tbody><tr><td style="padding:0 1em 10px 0;font-family:Arial,Sans-serif;font-size:13px;color:#888;white-space:nowrap" valign="top"><div><i style="font-style:normal">When</i></div></td><td style="padding-bottom:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222" valign="top"><time datetime="20170921T093000Z"></time><time datetime="20170921T100000Z"></time>Thu Sep 21, 2017 3pm – 3:30pm <span style="color:#888">India Standard Time</span></td></tr><tr><td style="padding:0 1em 10px 0;font-family:Arial,Sans-serif;font-size:13px;color:#888;white-space:nowrap" valign="top"><div><i style="font-style:normal">Calendar</i></div></td><td style="padding-bottom:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222" valign="top">Arun Raj</td></tr><tr><td style="padding:0 1em 10px 0;font-family:Arial,Sans-serif;font-size:13px;color:#888;white-space:nowrap" valign="top"><div><i style="font-style:normal">Who</i></div></td><td style="padding-bottom:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222" valign="top"><table cellspacing="0" cellpadding="0"><tbody><tr><td style="padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222"><span style="font-family:Courier New,monospace">•</span></td><td style="padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222"><div><div style="margin:0 0 0.3em 0"><span><span class="notranslate"><a href="mailto:amruth.raj@orisys.in" target="_blank">amruth.raj@orisys.in</a></span></span><span></span><span style="font-size:11px;color:#888"> - organizer</span></div></div></td></tr><tr><td style="padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222"><span style="font-family:Courier New,monospace">•</span></td><td style="padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222"><div><div style="margin:0 0 0.3em 0"><span><span class="notranslate">Binny V A</span></span></div></div></td></tr><tr><td style="padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222"><span style="font-family:Courier New,monospace">•</span></td><td style="padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222"><div><div style="margin:0 0 0.3em 0"><span><span class="notranslate"><a href="mailto:anand.a@orisys.in" target="_blank">anand.a@orisys.in</a></span></span></div></div></td></tr><tr><td style="padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222"><span style="font-family:Courier New,monospace">•</span></td><td style="padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222"><div><div style="margin:0 0 0.3em 0"><span><span class="notranslate"><a href="mailto:rejeesh.nair@orisys.in" target="_blank">rejeesh.nair@orisys.in</a></span></span></div></div></td></tr><tr><td style="padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222"><span style="font-family:Courier New,monospace">•</span></td><td style="padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222"><div><div style="margin:0 0 0.3em 0"><span><span class="notranslate">Jithin Nedumala</span></span></div></div></td></tr><tr><td style="padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222"><span style="font-family:Courier New,monospace">•</span></td><td style="padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222"><div><div style="margin:0 0 0.3em 0"><span><span class="notranslate">Arun Raj</span></span></div></div></td></tr><tr><td style="padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222"><span style="font-family:Courier New,monospace">•</span></td><td style="padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222"><div><div style="margin:0 0 0.3em 0"><span><span class="notranslate">Rajesh Balan</span></span></div></div></td></tr><tr><td style="padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222"><span style="font-family:Courier New,monospace">•</span></td><td style="padding-right:10px;font-family:Arial,Sans-serif;font-size:13px;color:#222"><div><div style="margin:0 0 0.3em 0"><span><span class="notranslate"><a href="mailto:nishant@makeadiff.in" target="_blank">nishant@makeadiff.in</a></span></span></div></div></td></tr></tbody></table></td></tr></tbody></table></div><p style="color:#222;font-size:13px;margin:0"><span style="color:#888">Going?   </span><strong><span><span><a href="https://www.google.com/calendar/event?action=RESPOND&amp;eid=MGozbDByMXYxcXNqY2FocjNodXQ3ZWsxOGogYXJ1bi5yYWpAb3Jpc3lzLmlu&amp;rst=1&amp;tok=MjAjYW1ydXRoLnJhakBvcmlzeXMuaW5hNDI3YjQ4MjJlN2M4OTJkMmY1ZjIxNGNjNGE4MWFlOTgzODQ0MDZh&amp;ctz=Asia/Calcutta&amp;hl=en" style="color:#20c;white-space:nowrap" target="_blank">Yes</a></span></span><span style="margin:0 0.4em;font-weight:normal"> - </span><span><span><a href="https://www.google.com/calendar/event?action=RESPOND&amp;eid=MGozbDByMXYxcXNqY2FocjNodXQ3ZWsxOGogYXJ1bi5yYWpAb3Jpc3lzLmlu&amp;rst=3&amp;tok=MjAjYW1ydXRoLnJhakBvcmlzeXMuaW5hNDI3YjQ4MjJlN2M4OTJkMmY1ZjIxNGNjNGE4MWFlOTgzODQ0MDZh&amp;ctz=Asia/Calcutta&amp;hl=en" style="color:#20c;white-space:nowrap" target="_blank">Maybe</a></span></span><span style="margin:0 0.4em;font-weight:normal"> - </span><span><span><a href="https://www.google.com/calendar/event?action=RESPOND&amp;eid=MGozbDByMXYxcXNqY2FocjNodXQ3ZWsxOGogYXJ1bi5yYWpAb3Jpc3lzLmlu&amp;rst=2&amp;tok=MjAjYW1ydXRoLnJhakBvcmlzeXMuaW5hNDI3YjQ4MjJlN2M4OTJkMmY1ZjIxNGNjNGE4MWFlOTgzODQ0MDZh&amp;ctz=Asia/Calcutta&amp;hl=en" style="color:#20c;white-space:nowrap" target="_blank">No</a></span></span></strong>    <a href="https://www.google.com/calendar/event?action=VIEW&amp;eid=MGozbDByMXYxcXNqY2FocjNodXQ3ZWsxOGogYXJ1bi5yYWpAb3Jpc3lzLmlu&amp;tok=MjAjYW1ydXRoLnJhakBvcmlzeXMuaW5hNDI3YjQ4MjJlN2M4OTJkMmY1ZjIxNGNjNGE4MWFlOTgzODQ0MDZh&amp;ctz=Asia/Calcutta&amp;hl=en" style="color:#20c;white-space:nowrap" target="_blank">more options »</a></p></td></tr><tr><td style="background-color:#f6f6f6;color:#888;border-top:1px Solid #ccc;font-family:Arial,Sans-serif;font-size:11px"><p>Invitation from <a href="https://www.google.com/calendar/" target="_blank">Google Calendar</a></p><p>You are receiving this email at the account <a href="mailto:arun.raj@orisys.in" target="_blank">arun.raj@orisys.in</a> because you are subscribed for invitations on calendar Arun Raj.</p><p>To stop receiving these emails, please log in to <a href="https://www.google.com/calendar/" target="_blank">https://www.google.com/<wbr>calendar/</a> and change your notification settings for this calendar.</p><p>Forwarding this invitation could allow any recipient to modify your RSVP response. <a href="https://support.google.com/calendar/answer/37135#forwarding" target="_blank">Learn More</a>.</p></td></tr></tbody></table></div></span></span></div><br><br clear="all"><div><br></div>-- <br><div class="gmail_signature" data-smartmail="gmail_signature"><div dir="ltr"><div><div dir="ltr"><div><div dir="ltr"><div>Arun Raj R</div><div>CEO,</div><div><b>OrisysIndia Consultancy Services LLP</b><br></div><div><a href="mailto:sales@orisys.in" target="_blank">sales@orisys.in</a><br><a href="http://www.orisys.in/" target="_blank">www.orisys.in</a></div><div><br></div><div>M: +919946014345 O: +918086800203</div><div>skype:arungv </div><div><br></div><div><a href="https://www.linkedin.com/in/arunrajr" target="_blank">LinkedIn</a></div><div><br></div><div><img width="200" height="54" src="http://orisys.in/Orisys_Christmas-Logo.png"><br><i><font size="1">Disclaimer : This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify us. This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</font></i></div></div></div></div></div></div></div>
</div>',
                'received_date' => '2017-09-27 02:28:58',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-09-27 14:59:01',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 53,
                'cmpny_id' => 2,
                'email_id' => 32,
                'thread_id' => 32,
                'from' => 'devika.devarajan@orisys.in',
                'from_name' => 'Devika Devarajan <devika.devarajan@orisys.in>',
                'subject' => 'Testing',
                'message' => 'Hi,

Welcome to ooty

Regards,


*Devika Devarajan*
Software Tester


*  OrisysIndia Consultancy Services LLP​.​*
​
"Driven by People, Technology & Values"
​

​​
Floor (-
​2​
), Thejaswini, Technopark
Thiruvananthapuram, Kerala, India, PIN 695 581


​   Office ​
: +91
​​04714015757
​   Web
:
​​
​
www.orisys.in​

​   Blog  :​
​www.orisys.in/blog


Disclaimer : This email and any files transmitted with it are confidential
and intended solely for the use of the individual or entity to whom they
are addressed. If you have received this email in error please notify us.
This message contains confidential information and is intended only for the
individual named. If you are not the named addressee you should not
disseminate, distribute or copy this e-mail. Please notify the sender
immediately by e-mail if you have received this e-mail by mistake and
delete this e-mail from your system. If you are not the intended recipient
you are notified that disclosing, copying, distributing or taking any
action in reliance on the contents of this information is strictly
prohibited.',
                'received_date' => '2017-09-29 09:49:21',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-09-29 10:06:20',
                'updated_at' => '2018-10-15 10:46:59',
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 54,
                'cmpny_id' => 2,
                'email_id' => 33,
                'thread_id' => 33,
                'from' => 'devika.devarajan@orisys.in',
                'from_name' => 'Devika Devarajan <devika.devarajan@orisys.in>',
                'subject' => 'Testing_email',
                'message' => 'hi,

testing mail template

Regards,


*Devika Devarajan*
Software Tester


*  OrisysIndia Consultancy Services LLP​.​*
​
"Driven by People, Technology & Values"
​

​​
Floor (-
​2​
), Thejaswini, Technopark
Thiruvananthapuram, Kerala, India, PIN 695 581


​   Office ​
: +91
​​04714015757
​   Web
:
​​
​
www.orisys.in​

​   Blog  :​
​www.orisys.in/blog


Disclaimer : This email and any files transmitted with it are confidential
and intended solely for the use of the individual or entity to whom they
are addressed. If you have received this email in error please notify us.
This message contains confidential information and is intended only for the
individual named. If you are not the named addressee you should not
disseminate, distribute or copy this e-mail. Please notify the sender
immediately by e-mail if you have received this e-mail by mistake and
delete this e-mail from your system. If you are not the intended recipient
you are notified that disclosing, copying, distributing or taking any
action in reliance on the contents of this information is strictly
prohibited.',
                'received_date' => '2017-09-29 09:57:34',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-09-29 10:06:21',
                'updated_at' => '2018-10-15 06:26:10',
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 55,
                'cmpny_id' => 2,
                'email_id' => 34,
                'thread_id' => 34,
                'from' => 'jayagth@gmail.com',
                'from_name' => '"Jayajith J.J" <jayagth@gmail.com>',
                'subject' => 'testing',
                'message' => 'hai ,

test',
                'received_date' => '2017-09-29 10:19:42',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-09-29 10:20:12',
                'updated_at' => '2018-10-15 06:26:16',
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 56,
                'cmpny_id' => 2,
                'email_id' => 0,
                'thread_id' => 34,
                'from' => 'oriesmarti@gmail.com',
                'from_name' => 'KSFE <oriesmarti@gmail.com>',
                'subject' => 'testing',
                'message' => 'ok process completed.',
                'received_date' => '2017-09-29 10:20:57',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-09-29 10:20:57',
                'updated_at' => '2018-10-15 06:26:16',
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 57,
                'cmpny_id' => 2,
                'email_id' => 0,
                'thread_id' => 34,
                'from' => 'oriesmarti@gmail.com',
                'from_name' => 'KSFE <oriesmarti@gmail.com>',
                'subject' => 'testing',
                'message' => 'please provide your phone number',
                'received_date' => '2017-09-29 10:22:20',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-09-29 10:22:20',
                'updated_at' => '2018-10-15 06:26:16',
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 58,
                'cmpny_id' => 2,
                'email_id' => 35,
                'thread_id' => 35,
                'from' => 'jayagth@gmail.com',
                'from_name' => '"Jayajith J.J" <jayagth@gmail.com>',
                'subject' => 'testing',
                'message' => '8129972384

On Fri, Sep 29, 2017 at 10:22 AM, KSFE <oriesmarti@gmail.com> wrote:

> please provide your phone number
>
> --
>
> Best Regards
> ------------------------------
> © 2017 | All Rights Reserved.
> test@gmail.com | www.ksfe.com
>',
                'received_date' => '2017-09-29 10:23:22',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-09-29 10:24:26',
                'updated_at' => '2018-10-15 06:25:29',
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 59,
                'cmpny_id' => 2,
                'email_id' => 36,
                'thread_id' => 35,
                'from' => 'jayagth@gmail.com',
                'from_name' => '"Jayajith J.J" <jayagth@gmail.com>',
                'subject' => 'testing',
                'message' => 'testing

On Fri, Sep 29, 2017 at 10:23 AM, Jayajith J.J <jayagth@gmail.com> wrote:

> 8129972384
>
> On Fri, Sep 29, 2017 at 10:22 AM, KSFE <oriesmarti@gmail.com> wrote:
>
>> please provide your phone number
>>
>> --
>>
>> Best Regards
>> ------------------------------
>> © 2017 | All Rights Reserved.
>> test@gmail.com | www.ksfe.com
>>
>
>',
                'received_date' => '2017-09-29 10:25:22',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-09-29 10:27:03',
                'updated_at' => '2018-10-15 06:25:29',
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 60,
                'cmpny_id' => 2,
                'email_id' => 37,
                'thread_id' => 35,
                'from' => 'jayagth@gmail.com',
                'from_name' => '"Jayajith J.J" <jayagth@gmail.com>',
                'subject' => 'testing',
                'message' => 'hello testing in process

On Fri, Sep 29, 2017 at 10:25 AM, Jayajith J.J <jayagth@gmail.com> wrote:

> testing
>
> On Fri, Sep 29, 2017 at 10:23 AM, Jayajith J.J <jayagth@gmail.com> wrote:
>
>> 8129972384
>>
>> On Fri, Sep 29, 2017 at 10:22 AM, KSFE <oriesmarti@gmail.com> wrote:
>>
>>> please provide your phone number
>>>
>>> --
>>>
>>> Best Regards
>>> ------------------------------
>>> © 2017 | All Rights Reserved.
>>> test@gmail.com | www.ksfe.com
>>>
>>
>>
>',
                'received_date' => '2017-09-29 10:27:43',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-09-29 10:28:52',
                'updated_at' => '2018-10-15 06:25:29',
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'id' => 61,
                'cmpny_id' => 2,
                'email_id' => 38,
                'thread_id' => 35,
                'from' => 'jayagth@gmail.com',
                'from_name' => '"Jayajith J.J" <jayagth@gmail.com>',
                'subject' => 'testing',
                'message' => 'retest

On Fri, Sep 29, 2017 at 10:27 AM, Jayajith J.J <jayagth@gmail.com> wrote:

> hello testing in process
>
> On Fri, Sep 29, 2017 at 10:25 AM, Jayajith J.J <jayagth@gmail.com> wrote:
>
>> testing
>>
>> On Fri, Sep 29, 2017 at 10:23 AM, Jayajith J.J <jayagth@gmail.com> wrote:
>>
>>> 8129972384
>>>
>>> On Fri, Sep 29, 2017 at 10:22 AM, KSFE <oriesmarti@gmail.com> wrote:
>>>
>>>> please provide your phone number
>>>>
>>>> --
>>>>
>>>> Best Regards
>>>> ------------------------------
>>>> © 2017 | All Rights Reserved.
>>>> test@gmail.com | www.ksfe.com
>>>>
>>>
>>>
>>
>',
                'received_date' => '2017-09-29 10:29:27',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-09-29 10:29:39',
                'updated_at' => '2018-10-15 06:25:29',
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 62,
                'cmpny_id' => 2,
                'email_id' => 39,
                'thread_id' => 35,
                'from' => 'jayagth@gmail.com',
                'from_name' => '"Jayajith J.J" <jayagth@gmail.com>',
                'subject' => 'testing',
                'message' => '4LSV4LWBICprdSogPSDwn5iG8J+YgvCfmIXwn4648J+PlfCfmrrwn4yL4LSVDQo',
                'received_date' => '2017-09-29 10:53:47',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-09-29 10:54:06',
                'updated_at' => '2018-10-15 06:25:29',
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'id' => 63,
                'cmpny_id' => 2,
                'email_id' => 40,
                'thread_id' => 35,
                'from' => 'jayagth@gmail.com',
                'from_name' => '"Jayajith J.J" <jayagth@gmail.com>',
                'subject' => 'testing',
                'message' => '4LSVDQoNCjIwMTctMDktMjkgMTA6NTMgR01UKzA1OjMwIEpheWFqaXRoIEouSiA8amF5YWd0aEBn
bWFpbC5jb20+Og0KDQo+DQo+DQo+IOC0leC1gSAqa3UqID0g8J+YhvCfmILwn5iF8J+OuPCfj5Xw
n5q68J+Mi+C0lQ0KPg0K',
                'received_date' => '2017-09-29 10:56:08',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-09-29 10:56:24',
                'updated_at' => '2018-10-15 06:25:29',
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'id' => 64,
                'cmpny_id' => 2,
                'email_id' => 41,
                'thread_id' => 35,
                'from' => 'jayagth@gmail.com',
                'from_name' => '"Jayajith J.J" <jayagth@gmail.com>',
                'subject' => 'testing',
                'message' => '<div dir="ltr">image<div class="gmail_extra"><br><div class="gmail_quote"><blockquote class="gmail_quote" style="margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex"><div class="gmail_extra"><div class="gmail_quote"><blockquote class="gmail_quote" style="margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex"><div dir="ltr"><div class="gmail_extra"><br></div></div>
</blockquote></div><br></div>
</blockquote></div><br></div></div>',
                'received_date' => '2017-09-29 11:00:45',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-09-29 11:01:14',
                'updated_at' => '2018-10-15 06:25:29',
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'id' => 65,
                'cmpny_id' => 2,
                'email_id' => 42,
                'thread_id' => 35,
                'from' => 'jayagth@gmail.com',
                'from_name' => '"Jayajith J.J" <jayagth@gmail.com>',
                'subject' => 'testing',
                'message' => '<div dir="ltr">gifs</div><div class="gmail_extra"><br><div class="gmail_quote">On Fri, Sep 29, 2017 at 11:00 AM, Jayajith J.J <span dir="ltr">&lt;<a href="mailto:jayagth@gmail.com" target="_blank">jayagth@gmail.com</a>&gt;</span> wrote:<br><blockquote class="gmail_quote" style="margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex"><div dir="ltr">image<div class="gmail_extra"><br><div class="gmail_quote"><blockquote class="gmail_quote" style="margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex"><div class="gmail_extra"><div class="gmail_quote"><blockquote class="gmail_quote" style="margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex"><div dir="ltr"><div class="gmail_extra"><br></div></div>
</blockquote></div><br></div>
</blockquote></div><br></div></div>
</blockquote></div><br></div>',
                'received_date' => '2017-09-29 11:03:41',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-09-29 11:04:04',
                'updated_at' => '2018-10-15 06:25:29',
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'id' => 66,
                'cmpny_id' => 2,
                'email_id' => 43,
                'thread_id' => 35,
                'from' => 'jayagth@gmail.com',
                'from_name' => '"Jayajith J.J" <jayagth@gmail.com>',
                'subject' => 'testing',
                'message' => '<div dir="ltr">pdf</div><div class="gmail_extra"><br><div class="gmail_quote">On Fri, Sep 29, 2017 at 11:03 AM, Jayajith J.J <span dir="ltr">&lt;<a href="mailto:jayagth@gmail.com" target="_blank">jayagth@gmail.com</a>&gt;</span> wrote:<br><blockquote class="gmail_quote" style="margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex"><div dir="ltr">gifs</div><div class="gmail_extra"><br><div class="gmail_quote">On Fri, Sep 29, 2017 at 11:00 AM, Jayajith J.J <span dir="ltr">&lt;<a href="mailto:jayagth@gmail.com" target="_blank">jayagth@gmail.com</a>&gt;</span> wrote:<br><blockquote class="gmail_quote" style="margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex"><div dir="ltr">image<div class="gmail_extra"><br><div class="gmail_quote"><blockquote class="gmail_quote" style="margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex"><div class="gmail_extra"><div class="gmail_quote"><blockquote class="gmail_quote" style="margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex"><div dir="ltr"><div class="gmail_extra"><br></div></div>
</blockquote></div><br></div>
</blockquote></div><br></div></div>
</blockquote></div><br></div>
</blockquote></div><br></div>',
                'received_date' => '2017-09-29 11:07:02',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-09-29 11:07:37',
                'updated_at' => '2018-10-15 06:25:29',
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'id' => 67,
                'cmpny_id' => 2,
                'email_id' => 44,
                'thread_id' => 35,
                'from' => 'jayagth@gmail.com',
                'from_name' => '"Jayajith J.J" <jayagth@gmail.com>',
                'subject' => 'testing',
                'message' => '<div dir="ltr">docx</div><div class="gmail_extra"><br><div class="gmail_quote">On Fri, Sep 29, 2017 at 11:07 AM, Jayajith J.J <span dir="ltr">&lt;<a href="mailto:jayagth@gmail.com" target="_blank">jayagth@gmail.com</a>&gt;</span> wrote:<br><blockquote class="gmail_quote" style="margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex"><div dir="ltr">pdf</div><div class="HOEnZb"><div class="h5"><div class="gmail_extra"><br><div class="gmail_quote">On Fri, Sep 29, 2017 at 11:03 AM, Jayajith J.J <span dir="ltr">&lt;<a href="mailto:jayagth@gmail.com" target="_blank">jayagth@gmail.com</a>&gt;</span> wrote:<br><blockquote class="gmail_quote" style="margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex"><div dir="ltr">gifs</div><div class="gmail_extra"><br><div class="gmail_quote">On Fri, Sep 29, 2017 at 11:00 AM, Jayajith J.J <span dir="ltr">&lt;<a href="mailto:jayagth@gmail.com" target="_blank">jayagth@gmail.com</a>&gt;</span> wrote:<br><blockquote class="gmail_quote" style="margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex"><div dir="ltr">image<div class="gmail_extra"><br><div class="gmail_quote"><blockquote class="gmail_quote" style="margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex"><div class="gmail_extra"><div class="gmail_quote"><blockquote class="gmail_quote" style="margin:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex"><div dir="ltr"><div class="gmail_extra"><br></div></div>
</blockquote></div><br></div>
</blockquote></div><br></div></div>
</blockquote></div><br></div>
</blockquote></div><br></div>
</div></div></blockquote></div><br></div>',
                'received_date' => '2017-09-29 11:11:01',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-09-29 11:11:44',
                'updated_at' => '2018-10-15 06:25:29',
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'id' => 68,
                'cmpny_id' => 2,
                'email_id' => 45,
                'thread_id' => 35,
                'from' => 'jayagth@gmail.com',
                'from_name' => '"Jayajith J.J" <jayagth@gmail.com>',
                'subject' => 'testing',
                'message' => 'Hai* hello** testing done*

On Fri, Sep 29, 2017 at 11:10 AM, Jayajith J.J <jayagth@gmail.com> wrote:

> docx
>
> On Fri, Sep 29, 2017 at 11:07 AM, Jayajith J.J <jayagth@gmail.com> wrote:
>
>> pdf
>>
>> On Fri, Sep 29, 2017 at 11:03 AM, Jayajith J.J <jayagth@gmail.com> wrote:
>>
>>> gifs
>>>
>>> On Fri, Sep 29, 2017 at 11:00 AM, Jayajith J.J <jayagth@gmail.com>
>>> wrote:
>>>
>>>> image
>>>>
>>>>
>>>>>>
>>>>>
>>>>
>>>
>>
>',
                'received_date' => '2017-09-29 11:20:00',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-09-29 11:20:18',
                'updated_at' => '2018-10-15 06:25:29',
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'id' => 70,
                'cmpny_id' => 2,
                'email_id' => 47,
                'thread_id' => 47,
                'from' => 'devarajandevika24@gmail.com',
                'from_name' => 'Devika Devarajan <devarajandevika24@gmail.com>',
                'subject' => 'help me',
                'message' => 'Hi,

Could you please help me with the kyc verification steps

--
Thanks And Regards,


*Devika Devarajan*',
                'received_date' => '2017-09-29 12:01:03',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-09-29 12:40:47',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            52 => 
            array (
                'id' => 71,
                'cmpny_id' => 2,
                'email_id' => 0,
                'thread_id' => 47,
                'from' => 'oriesmarti@gmail.com',
                'from_name' => 'KSFE <oriesmarti@gmail.com>',
                'subject' => 'help me',
                'message' => 'choose an agent and go to the agent with the generated code. submit all documents',
                'received_date' => '2017-09-29 13:45:26',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-09-29 13:45:26',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            53 => 
            array (
                'id' => 128,
                'cmpny_id' => 2,
                'email_id' => 48,
                'thread_id' => 48,
                'from' => 'chinnu.l@orisys.in',
                'from_name' => 'Chinnu L <chinnu.l@orisys.in>',
                'subject' => 'ടെസ്റ്റ് മെയിൽ',
            'message' => '<div dir="ltr"><div>ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  ടെസ്റ്റ് മെയിൽ കണ്ടന്റ് <br></div>-- <br><div class="gmail_signature"><div dir="ltr"><div><div dir="ltr"><div><div dir="ltr"><div><div dir="ltr"><div><div style="font-size:12.8px;font-family:verdana,sans-serif"><br></div></div><div style="font-size:12.8px"><div style="font-family:arial,sans-serif;font-size:12.8px"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)"><tbody><tr><td><span style="padding:0px;margin:0px;font-size:10pt"><font face="verdana, sans-serif">Regards,<br><br></font></span></td></tr><tr><td style="border-bottom:1px solid rgb(184,32,37)"></td></tr><tr><td></td></tr><tr><td><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-size:8pt;line-height:9pt"><tbody><tr><td><span style="padding:0px;margin:0px;font-size:10pt"><font face="verdana, sans-serif"><b><div style="display:inline">​<br></div></b><font color="#000000"><font style="font-size:12.8px;line-height:normal">Chinnu L</font><font style="font-size:12.8px;line-height:normal"> </font><font style="font-size:12.8px;line-height:normal"> </font></font><b><div style="display:inline"><br></div></b></font></span></td></tr><tr><td><span style="padding:0px;margin:0px;font-size:9pt"><div style="display:inline"><font face="verdana, sans-serif"><div style="color:rgb(112,113,115);display:inline">​</div><span style="font-size:12.8px;line-height:normal"><font color="#444444">Team Lead-Web Team</font></span><br><table border="0" cellpadding="0" cellspacing="0" width="239" style="color:rgb(112,113,115);border-collapse:collapse;width:179pt"><tbody><tr height="36" style="height:27pt"><td height="36" align="right" width="175" style="height:27pt;width:131pt"><img src="http://orisys.in/orisys_logo.png"> <br></td><td align="right" width="64" style="width:48pt"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="line-height:9pt;text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap"><tbody><tr><td><span style="font-size:10pt"><b><div style="display:inline">  <span>OrisysIndia</span> Consultancy Services LLP​</div>.<br><div style="display:inline">​</div></b></span><span style="line-height:normal;white-space:normal"><div style="font-size:small;font-weight:bold;color:rgb(204,0,0);display:inline">​  </div><font color="#000000" size="1">&quot;Driven by People, Technology &amp; Values&quot; </font></span><span style="line-height:9pt"><div style="display:inline"><font color="#000000" size="1">​</font></div></span><span style="font-size:10pt"><b><div style="display:inline"><br></div></b></span></td></tr><tr><td><div style="display:inline">​​   D3</div>, 6th Floor Bhavani Building, Technopark</td></tr><tr><td>    Thiruvananthapuram, Kerala, <span>India</span>, PIN 695 581</td></tr></tbody></table><br style="text-align:start;color:rgb(50,50,50);font-size:10.6667px;white-space:nowrap;line-height:4pt"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap;line-height:10pt"><tbody><tr><td width="35"><div style="display:inline">​   Mob   ​</div>:</td><td><div style="display:inline">​<div style="font-size:10.6667px;line-height:13.3333px;display:inline">​</div><span style="font-size:10.6667px;line-height:13.3333px">+91 (0) </span><div style="font-size:10.6667px;line-height:13.3333px;display:inline">​9995381265</div><span style="font-size:8pt;line-height:10pt"> </span><br></div></td></tr><tr><td><div style="display:inline">​   Office ​</div>:</td><td>+91  <div style="display:inline">​<span style="font-size:10.6667px;line-height:13.3333px">​04714015757</span><br></div></td></tr><tr><td><div style="display:inline">​   Web   </div>:</td><td><div style="display:inline">​​</div><div style="display:inline">​</div><span style="font-size:10.6667px;line-height:13.3333px"><a href="http://www.orisys.in/" style="color:rgb(17,85,204)" target="_blank">www.<span>orisys</span>.in</a>​</span></td></tr><tr><td><div style="display:inline">​   Blog  :​</div></td><td><div style="display:inline">​<a href="http://www.orisys.in/blog" style="color:rgb(17,85,204)" target="_blank">www.<span>orisys</span>.in/blog</a></div></td></tr></tbody></table></td></tr></tbody></table></font></div></span></td></tr></tbody></table></td></tr><tr><td style="border-bottom:1px solid rgb(200,200,200)"><font face="verdana, sans-serif"><br></font></td></tr></tbody></table></div><div style="font-size:12.8px"><div><div><font face="verdana, sans-serif"> <br></font></div><font face="verdana, sans-serif"><font color="#666666" style="font-size:x-small"><div style="text-align:center"><span style="font-size:small"></span></div></font><font color="#666666" style="font-size:x-small"><div style="text-align:center"><div style="text-align:left">Disclaimer : This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify us. This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</div></div></font></font></div></div></div></div></div></div></div></div></div></div></div>
</div>',
                'received_date' => '2017-10-16 03:26:03',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-10-17 18:40:22',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            54 => 
            array (
                'id' => 129,
                'cmpny_id' => 2,
                'email_id' => 49,
                'thread_id' => 49,
                'from' => 'chinnu.l@orisys.in',
                'from_name' => 'Chinnu L <chinnu.l@orisys.in>',
                'subject' => 'ടെസ്റ്റ് മെയിൽ2',
                'message' => '<div dir="ltr"><br clear="all"><div><span style="font-size:12.8px">ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  ടെസ്റ്റ് മെയിൽ കണ്ടന്റ് </span></div>
</div>
',
                'received_date' => '2017-10-16 06:17:57',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-10-17 18:40:23',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            55 => 
            array (
                'id' => 130,
                'cmpny_id' => 2,
                'email_id' => 50,
                'thread_id' => 50,
                'from' => 'chinnu.l@orisys.in',
                'from_name' => 'Chinnu L <chinnu.l@orisys.in>',
                'subject' => 'test',
            'message' => '<div dir="ltr">test test<br clear="all"><div><br></div>-- <br><div class="gmail_signature" data-smartmail="gmail_signature"><div dir="ltr"><div><div dir="ltr"><div><div dir="ltr"><div><div dir="ltr"><div><div style="font-size:12.8000001907349px;font-family:verdana,sans-serif"><br></div></div><div style="font-size:12.8px"><div style="font-family:arial,sans-serif;font-size:12.8px"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)"><tbody><tr><td><span style="padding:0px;margin:0px;font-size:10pt"><font face="verdana, sans-serif">Regards,<br><br></font></span></td></tr><tr><td style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:rgb(184,32,37)"></td></tr><tr><td></td></tr><tr><td><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-size:8pt;line-height:9pt"><tbody><tr><td><span style="padding:0px;margin:0px;font-size:10pt"><font face="verdana, sans-serif"><b><div style="display:inline">​<br></div></b><font color="#000000"><font style="font-size:12.8px;line-height:normal">Chinnu L</font><font style="font-size:12.8px;line-height:normal"> </font><font style="font-size:12.8px;line-height:normal"> </font></font><b><div style="display:inline"><br></div></b></font></span></td></tr><tr><td><span style="padding:0px;margin:0px;font-size:9pt"><div style="display:inline"><font face="verdana, sans-serif"><div style="color:rgb(112,113,115);display:inline">​</div><span style="font-size:12.8px;line-height:normal"><font color="#444444">Team Lead-Web Team</font></span><br><table border="0" cellpadding="0" cellspacing="0" width="239" style="color:rgb(112,113,115);border-collapse:collapse;width:179pt"><tbody><tr height="36" style="height:27pt"><td height="36" align="right" width="175" style="height:27pt;width:131pt"><img src="http://orisys.in/orisys_logo.png"> <br></td><td align="right" width="64" style="width:48pt"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="line-height:9pt;text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap"><tbody><tr><td><span style="font-size:10pt"><b><div style="display:inline">  <span>OrisysIndia</span> Consultancy Services LLP​</div>.<br><div style="display:inline">​</div></b></span><span style="line-height:normal;white-space:normal"><div style="font-size:small;font-weight:bold;color:rgb(204,0,0);display:inline">​  </div><font color="#000000" size="1">&quot;Driven by People, Technology &amp; Values&quot; </font></span><span style="line-height:9pt"><div style="display:inline"><font color="#000000" size="1">​</font></div></span><span style="font-size:10pt"><b><div style="display:inline"><br></div></b></span></td></tr><tr><td><div style="display:inline">​​   D3</div>, 6th Floor Bhavani Building, Technopark</td></tr><tr><td>    Thiruvananthapuram, Kerala, <span>India</span>, PIN 695 581</td></tr></tbody></table><br style="text-align:start;color:rgb(50,50,50);font-size:10.6667px;white-space:nowrap;line-height:4pt"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap;line-height:10pt"><tbody><tr><td width="35"><div style="display:inline">​   Mob   ​</div>:</td><td><div style="display:inline">​<div style="font-size:10.6667px;line-height:13.3333px;display:inline">​</div><span style="font-size:10.6667px;line-height:13.3333px">+91 (0) </span><div style="font-size:10.6667px;line-height:13.3333px;display:inline">​9995381265</div><span style="font-size:8pt;line-height:10pt"> </span><br></div></td></tr><tr><td><div style="display:inline">​   Office ​</div>:</td><td>+91  <div style="display:inline">​<span style="font-size:10.6667px;line-height:13.3333px">​04714015757</span><br></div></td></tr><tr><td><div style="display:inline">​   Web   </div>:</td><td><div style="display:inline">​​</div><div style="display:inline">​</div><span style="font-size:10.6667px;line-height:13.3333px"><a href="http://www.orisys.in/" style="color:rgb(17,85,204)" target="_blank">www.<span>orisys</span>.in</a>​</span></td></tr><tr><td><div style="display:inline">​   Blog  :​</div></td><td><div style="display:inline">​<a href="http://www.orisys.in/blog" style="color:rgb(17,85,204)" target="_blank">www.<span>orisys</span>.in/blog</a></div></td></tr></tbody></table></td></tr></tbody></table></font></div></span></td></tr></tbody></table></td></tr><tr><td style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:rgb(200,200,200)"><font face="verdana, sans-serif"><br></font></td></tr></tbody></table></div><div style="font-size:12.8px"><div><div><font face="verdana, sans-serif"> <br></font></div><font face="verdana, sans-serif"><font color="#666666" style="font-size:x-small"><div style="text-align:center"><span style="font-size:small"></span></div></font><font color="#666666" style="font-size:x-small"><div style="text-align:center"><div style="text-align:left">Disclaimer : This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify us. This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</div></div></font></font></div></div></div></div></div></div></div></div></div></div></div>
</div>',
                'received_date' => '2017-10-16 06:58:20',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-10-17 18:40:23',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'id' => 131,
                'cmpny_id' => 2,
                'email_id' => 51,
                'thread_id' => 51,
                'from' => 'chinnu.l@orisys.in',
                'from_name' => 'Chinnu L <chinnu.l@orisys.in>',
                'subject' => 'testing html',
            'message' => '<div dir="ltr"><strong style="margin:0px;padding:0px;color:rgb(0,0,0);font-family:&quot;Open Sans&quot;,Arial,sans-serif;font-size:14px;text-align:justify">Lorem Ipsum</strong><span style="color:rgb(0,0,0);font-family:&quot;Open Sans&quot;,Arial,sans-serif;font-size:14px;text-align:justify"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</span><br clear="all"><div><br></div>-- <br><div class="gmail_signature"><div dir="ltr"><div><div dir="ltr"><div><div dir="ltr"><div><div dir="ltr"><div><div style="font-size:12.8px;font-family:verdana,sans-serif"><br></div></div><div style="font-size:12.8px"><div style="font-family:arial,sans-serif;font-size:12.8px"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)"><tbody><tr><td><span style="padding:0px;margin:0px;font-size:10pt"><font face="verdana, sans-serif">Regards,<br><br></font></span></td></tr><tr><td style="border-bottom:1px solid rgb(184,32,37)"></td></tr><tr><td></td></tr><tr><td><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-size:8pt;line-height:9pt"><tbody><tr><td><span style="padding:0px;margin:0px;font-size:10pt"><font face="verdana, sans-serif"><b><div style="display:inline">​<br></div></b><font color="#000000"><font style="font-size:12.8px;line-height:normal">Chinnu L</font><font style="font-size:12.8px;line-height:normal"> </font><font style="font-size:12.8px;line-height:normal"> </font></font><b><div style="display:inline"><br></div></b></font></span></td></tr><tr><td><span style="padding:0px;margin:0px;font-size:9pt"><div style="display:inline"><font face="verdana, sans-serif"><div style="color:rgb(112,113,115);display:inline">​</div><span style="font-size:12.8px;line-height:normal"><font color="#444444">Team Lead-Web Team</font></span><br><table border="0" cellpadding="0" cellspacing="0" width="239" style="color:rgb(112,113,115);border-collapse:collapse;width:179pt"><tbody><tr height="36" style="height:27pt"><td height="36" align="right" width="175" style="height:27pt;width:131pt"><img src="http://orisys.in/orisys_logo.png"> <br></td><td align="right" width="64" style="width:48pt"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="line-height:9pt;text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap"><tbody><tr><td><span style="font-size:10pt"><b><div style="display:inline">  <span>OrisysIndia</span> Consultancy Services LLP​</div>.<br><div style="display:inline">​</div></b></span><span style="line-height:normal;white-space:normal"><div style="font-size:small;font-weight:bold;color:rgb(204,0,0);display:inline">​  </div><font color="#000000" size="1">&quot;Driven by People, Technology &amp; Values&quot; </font></span><span style="line-height:9pt"><div style="display:inline"><font color="#000000" size="1">​</font></div></span><span style="font-size:10pt"><b><div style="display:inline"><br></div></b></span></td></tr><tr><td><div style="display:inline">​​   D3</div>, 6th Floor Bhavani Building, Technopark</td></tr><tr><td>    Thiruvananthapuram, Kerala, <span>India</span>, PIN 695 581</td></tr></tbody></table><br style="text-align:start;color:rgb(50,50,50);font-size:10.6667px;white-space:nowrap;line-height:4pt"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap;line-height:10pt"><tbody><tr><td width="35"><div style="display:inline">​   Mob   ​</div>:</td><td><div style="display:inline">​<div style="font-size:10.6667px;line-height:13.3333px;display:inline">​</div><span style="font-size:10.6667px;line-height:13.3333px">+91 (0) </span><div style="font-size:10.6667px;line-height:13.3333px;display:inline">​9995381265</div><span style="font-size:8pt;line-height:10pt"> </span><br></div></td></tr><tr><td><div style="display:inline">​   Office ​</div>:</td><td>+91  <div style="display:inline">​<span style="font-size:10.6667px;line-height:13.3333px">​04714015757</span><br></div></td></tr><tr><td><div style="display:inline">​   Web   </div>:</td><td><div style="display:inline">​​</div><div style="display:inline">​</div><span style="font-size:10.6667px;line-height:13.3333px"><a href="http://www.orisys.in/" style="color:rgb(17,85,204)" target="_blank">www.<span>orisys</span>.in</a>​</span></td></tr><tr><td><div style="display:inline">​   Blog  :​</div></td><td><div style="display:inline">​<a href="http://www.orisys.in/blog" style="color:rgb(17,85,204)" target="_blank">www.<span>orisys</span>.in/blog</a></div></td></tr></tbody></table></td></tr></tbody></table></font></div></span></td></tr></tbody></table></td></tr><tr><td style="border-bottom:1px solid rgb(200,200,200)"><font face="verdana, sans-serif"><br></font></td></tr></tbody></table></div><div style="font-size:12.8px"><div><div><font face="verdana, sans-serif"> <br></font></div><font face="verdana, sans-serif"><font color="#666666" style="font-size:x-small"><div style="text-align:center"><span style="font-size:small"></span></div></font><font color="#666666" style="font-size:x-small"><div style="text-align:center"><div style="text-align:left">Disclaimer : This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify us. This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</div></div></font></font></div></div></div></div></div></div></div></div></div></div></div>
</div>',
                'received_date' => '2017-10-17 05:39:41',
                'submit_status' => 0,
                'read_status' => 0,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-10-17 18:40:24',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'id' => 132,
                'cmpny_id' => 2,
                'email_id' => 52,
                'thread_id' => 48,
                'from' => 'chinnu.l@orisys.in',
                'from_name' => 'Chinnu L <chinnu.l@orisys.in>',
                'subject' => 'ടെസ്റ്റ് മെയിൽ',
            'message' => '<div dir="ltr"><span style="font-size:12.8px">ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  </span><span style="font-size:12.8px">ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  </span><br><div class="gmail_extra"><br><div class="gmail_quote">On Mon, Oct 16, 2017 at 3:26 PM, Chinnu L <span dir="ltr">&lt;<a href="mailto:chinnu.l@orisys.in" target="_blank">chinnu.l@orisys.in</a>&gt;</span> wrote:<br><blockquote class="gmail_quote" style="margin:0px 0px 0px 0.8ex;border-left:1px solid rgb(204,204,204);padding-left:1ex"><div dir="ltr"><div>ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  ടെസ്റ്റ് മെയിൽ കണ്ടന്റ്  ടെസ്റ്റ് മെയിൽ കണ്ടന്റ് <br></div>-- <br><div class="gmail-m_-7751595880041415137gmail_signature"><div dir="ltr"><div><div dir="ltr"><div><div dir="ltr"><div><div dir="ltr"><div><div style="font-size:12.8px;font-family:verdana,sans-serif"><br></div></div><div style="font-size:12.8px"><div style="font-family:arial,sans-serif;font-size:12.8px"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)"><tbody><tr><td><span style="padding:0px;margin:0px;font-size:10pt"><font face="verdana, sans-serif">Regards,<br><br></font></span></td></tr><tr><td style="border-bottom:1px solid rgb(184,32,37)"></td></tr><tr><td></td></tr><tr><td><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-size:8pt;line-height:9pt"><tbody><tr><td><span style="padding:0px;margin:0px;font-size:10pt"><font face="verdana, sans-serif"><b><div style="display:inline">​<br></div></b><font color="#000000"><font style="font-size:12.8px;line-height:normal">Chinnu L</font><font style="font-size:12.8px;line-height:normal"> </font><font style="font-size:12.8px;line-height:normal"> </font></font><b><div style="display:inline"><br></div></b></font></span></td></tr><tr><td><span style="padding:0px;margin:0px;font-size:9pt"><div style="display:inline"><font face="verdana, sans-serif"><div style="color:rgb(112,113,115);display:inline">​</div><span style="font-size:12.8px;line-height:normal"><font color="#444444">Team Lead-Web Team</font></span><br><table border="0" cellpadding="0" cellspacing="0" width="239" style="color:rgb(112,113,115);border-collapse:collapse;width:179pt"><tbody><tr height="36" style="height:27pt"><td height="36" align="right" width="175" style="height:27pt;width:131pt"><img src="http://orisys.in/orisys_logo.png"> <br></td><td align="right" width="64" style="width:48pt"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="line-height:9pt;text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap"><tbody><tr><td><span style="font-size:10pt"><b><div style="display:inline">  <span>OrisysIndia</span> Consultancy Services LLP​</div>.<br><div style="display:inline">​</div></b></span><span style="line-height:normal;white-space:normal"><div style="font-size:small;font-weight:bold;color:rgb(204,0,0);display:inline">​  </div><font color="#000000" size="1">&quot;Driven by People, Technology &amp; Values&quot; </font></span><span style="line-height:9pt"><div style="display:inline"><font color="#000000" size="1">​</font></div></span><span style="font-size:10pt"><b><div style="display:inline"><br></div></b></span></td></tr><tr><td><div style="display:inline">​​   D3</div>, 6th Floor Bhavani Building, Technopark</td></tr><tr><td>    Thiruvananthapuram, Kerala, <span>India</span>, PIN 695 581</td></tr></tbody></table><br style="text-align:start;color:rgb(50,50,50);font-size:10.6667px;white-space:nowrap;line-height:4pt"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap;line-height:10pt"><tbody><tr><td width="35"><div style="display:inline">​   Mob   ​</div>:</td><td><div style="display:inline">​<div style="font-size:10.6667px;line-height:13.3333px;display:inline">​</div><span style="font-size:10.6667px;line-height:13.3333px">+91 (0) </span><div style="font-size:10.6667px;line-height:13.3333px;display:inline">​9995381265</div><span style="font-size:8pt;line-height:10pt"> </span><br></div></td></tr><tr><td><div style="display:inline">​   Office ​</div>:</td><td>+91  <div style="display:inline">​<span style="font-size:10.6667px;line-height:13.3333px">​04714015757</span><br></div></td></tr><tr><td><div style="display:inline">​   Web   </div>:</td><td><div style="display:inline">​​</div><div style="display:inline">​</div><span style="font-size:10.6667px;line-height:13.3333px"><a href="http://www.orisys.in/" style="color:rgb(17,85,204)" target="_blank">www.<span>orisys</span>.in</a>​</span></td></tr><tr><td><div style="display:inline">​   Blog  :​</div></td><td><div style="display:inline">​<a href="http://www.orisys.in/blog" style="color:rgb(17,85,204)" target="_blank">www.<span>orisys</span>.in/blog</a></div></td></tr></tbody></table></td></tr></tbody></table></font></div></span></td></tr></tbody></table></td></tr><tr><td style="border-bottom:1px solid rgb(200,200,200)"><font face="verdana, sans-serif"><br></font></td></tr></tbody></table></div><div style="font-size:12.8px"><div><div><font face="verdana, sans-serif"> <br></font></div><font face="verdana, sans-serif"><font color="#666666" style="font-size:x-small"><div style="text-align:center"><span style="font-size:small"></span></div></font><font color="#666666" style="font-size:x-small"><div style="text-align:center"><div style="text-align:left">Disclaimer : This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify us. This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</div></div></font></font></div></div></div></div></div></div></div></div></div></div></div>
</div>
</blockquote></div><br><br clear="all"><div><br></div>-- <br><div class="gmail_signature"><div dir="ltr"><div><div dir="ltr"><div><div dir="ltr"><div><div dir="ltr"><div><div style="font-size:12.8px;font-family:verdana,sans-serif"><br></div></div><div style="font-size:12.8px"><div style="font-family:arial,sans-serif;font-size:12.8px"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)"><tbody><tr><td><span style="padding:0px;margin:0px;font-size:10pt"><font face="verdana, sans-serif">Regards,<br><br></font></span></td></tr><tr><td style="border-bottom:1px solid rgb(184,32,37)"></td></tr><tr><td></td></tr><tr><td><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-size:8pt;line-height:9pt"><tbody><tr><td><span style="padding:0px;margin:0px;font-size:10pt"><font face="verdana, sans-serif"><b><div style="display:inline">​<br></div></b><font color="#000000"><font style="font-size:12.8px;line-height:normal">Chinnu L</font><font style="font-size:12.8px;line-height:normal"> </font><font style="font-size:12.8px;line-height:normal"> </font></font><b><div style="display:inline"><br></div></b></font></span></td></tr><tr><td><span style="padding:0px;margin:0px;font-size:9pt"><div style="display:inline"><font face="verdana, sans-serif"><div style="color:rgb(112,113,115);display:inline">​</div><span style="font-size:12.8px;line-height:normal"><font color="#444444">Team Lead-Web Team</font></span><br><table border="0" cellpadding="0" cellspacing="0" width="239" style="color:rgb(112,113,115);border-collapse:collapse;width:179pt"><tbody><tr height="36" style="height:27pt"><td height="36" align="right" width="175" style="height:27pt;width:131pt"><img src="http://orisys.in/orisys_logo.png"> <br></td><td align="right" width="64" style="width:48pt"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="line-height:9pt;text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap"><tbody><tr><td><span style="font-size:10pt"><b><div style="display:inline">  <span>OrisysIndia</span> Consultancy Services LLP​</div>.<br><div style="display:inline">​</div></b></span><span style="line-height:normal;white-space:normal"><div style="font-size:small;font-weight:bold;color:rgb(204,0,0);display:inline">​  </div><font color="#000000" size="1">&quot;Driven by People, Technology &amp; Values&quot; </font></span><span style="line-height:9pt"><div style="display:inline"><font color="#000000" size="1">​</font></div></span><span style="font-size:10pt"><b><div style="display:inline"><br></div></b></span></td></tr><tr><td><div style="display:inline">​​   D3</div>, 6th Floor Bhavani Building, Technopark</td></tr><tr><td>    Thiruvananthapuram, Kerala, <span>India</span>, PIN 695 581</td></tr></tbody></table><br style="text-align:start;color:rgb(50,50,50);font-size:10.6667px;white-space:nowrap;line-height:4pt"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="text-align:start;color:rgb(50,50,50);font-size:8pt;white-space:nowrap;line-height:10pt"><tbody><tr><td width="35"><div style="display:inline">​   Mob   ​</div>:</td><td><div style="display:inline">​<div style="font-size:10.6667px;line-height:13.3333px;display:inline">​</div><span style="font-size:10.6667px;line-height:13.3333px">+91 (0) </span><div style="font-size:10.6667px;line-height:13.3333px;display:inline">​9995381265</div><span style="font-size:8pt;line-height:10pt"> </span><br></div></td></tr><tr><td><div style="display:inline">​   Office ​</div>:</td><td>+91  <div style="display:inline">​<span style="font-size:10.6667px;line-height:13.3333px">​04714015757</span><br></div></td></tr><tr><td><div style="display:inline">​   Web   </div>:</td><td><div style="display:inline">​​</div><div style="display:inline">​</div><span style="font-size:10.6667px;line-height:13.3333px"><a href="http://www.orisys.in/" style="color:rgb(17,85,204)" target="_blank">www.<span>orisys</span>.in</a>​</span></td></tr><tr><td><div style="display:inline">​   Blog  :​</div></td><td><div style="display:inline">​<a href="http://www.orisys.in/blog" style="color:rgb(17,85,204)" target="_blank">www.<span>orisys</span>.in/blog</a></div></td></tr></tbody></table></td></tr></tbody></table></font></div></span></td></tr></tbody></table></td></tr><tr><td style="border-bottom:1px solid rgb(200,200,200)"><font face="verdana, sans-serif"><br></font></td></tr></tbody></table></div><div style="font-size:12.8px"><div><div><font face="verdana, sans-serif"> <br></font></div><font face="verdana, sans-serif"><font color="#666666" style="font-size:x-small"><div style="text-align:center"><span style="font-size:small"></span></div></font><font color="#666666" style="font-size:x-small"><div style="text-align:center"><div style="text-align:left">Disclaimer : This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify us. This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</div></div></font></font></div></div></div></div></div></div></div></div></div></div></div>
</div></div>',
                'received_date' => '2017-10-19 11:31:35',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-10-19 11:31:49',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'id' => 133,
                'cmpny_id' => 2,
                'email_id' => 53,
                'thread_id' => 53,
                'from' => 'devika.devarajan@orisys.in',
                'from_name' => 'Devika Devarajan <devika.devarajan@orisys.in>',
                'subject' => 'hai',
            'message' => '<div dir="ltr"><div class="gmail_default"><font face="verdana, sans-serif">ചിട്ടിയി;ല്‍ എങ്ങനെ ചേരാം ?</font><br></div><div class="gmail_default" style="font-family:verdana,sans-serif"><br></div><div class="gmail_default" style="font-family:verdana,sans-serif"><br></div><div class="gmail_default" style="font-family:verdana,sans-serif"><br></div><div class="gmail_default" style="font-family:verdana,sans-serif"><br><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)"><tbody><tr style="font-size:9pt"><td><span style="padding:0px;margin:0px;font-size:10pt">Regards,<br><br></span></td></tr><tr style="font-size:9pt"><td style="border-bottom:1px solid rgb(184,32,37)"></td></tr><tr style="font-size:9pt"><td></td></tr><tr style="font-size:9pt"></tr></tbody></table></div><div><div class="gmail_signature"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><br><div style="font-size:12.8px"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><div dir="ltr"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="color:rgb(50,50,50);font-family:Arial,Helvetica,sans-serif;font-size:8pt;line-height:9pt"><tbody><tr><td><font face="verdana, sans-serif"><span style="font-size:13.3333px"><b>Devika Devarajan</b></span></font><span style="color:rgb(112,113,115);font-family:verdana,sans-serif;font-size:12px"><br>Software Tester<br></span><table border="0" cellpadding="0" cellspacing="0" width="172" style="border-collapse:collapse;width:129pt"><tbody><tr height="20" style="height:15pt">
<td height="20" width="108" style="height:15pt;width:81pt"><img src="http://orisys.in/orisys_logo.png"><br></td>
<td width="64" style="width:48pt"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="line-height:9pt;font-family:Arial,Helvetica,sans-serif;font-size:8pt;white-space:nowrap"><tbody><tr><td><span style="font-family:Arial,Helvetica,sans-serif;font-size:10pt"><b><div style="font-family:verdana,sans-serif;display:inline">  OrisysIndia Consultancy Services LLP​</div>.<br><div style="font-family:verdana,sans-serif;display:inline">​</div></b></span><span style="font-family:verdana,sans-serif;line-height:normal;white-space:normal"><div style="font-size:small;font-weight:bold;color:rgb(204,0,0);display:inline">​  </div><font color="#000000" size="1">&quot;Driven by People, Technology &amp; Values&quot; </font></span><span style="font-family:Arial,Helvetica,sans-serif;line-height:9pt"><div style="font-family:verdana,sans-serif;display:inline"><font color="#000000" size="1">​</font></div></span><span style="font-family:Arial,Helvetica,sans-serif;font-size:10pt"><b><div style="font-family:verdana,sans-serif;display:inline"><br></div></b></span></td></tr><tr><td><div style="font-family:verdana,sans-serif;display:inline">​​   </div>Floor (-<div style="font-family:verdana,sans-serif;display:inline">​2​</div>), Thejaswini, Technopark</td></tr><tr><td>    Thiruvananthapuram, Kerala, India, PIN 695 581</td></tr></tbody></table><br style="font-family:Arial,Helvetica,sans-serif;font-size:10.6667px;white-space:nowrap;line-height:4pt"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;font-size:8pt;white-space:nowrap;line-height:10pt"><tbody><tr><td width="35"><br></td><td><div style="font-family:verdana,sans-serif;display:inline"><br></div></td></tr><tr><td><div style="font-family:verdana,sans-serif;display:inline">​   Office ​</div>:</td><td>+91  <div style="font-family:verdana,sans-serif;display:inline">​<span style="font-size:10.6667px;line-height:13.3333px">​04714015757</span><br></div></td></tr><tr><td><div style="font-family:verdana,sans-serif;display:inline">​   Web   </div>:</td><td><div style="font-family:verdana,sans-serif;display:inline">​​</div><div style="font-family:verdana,sans-serif;display:inline">​</div><span style="font-family:verdana,sans-serif;font-size:10.6667px;line-height:13.3333px"><a href="http://www.orisys.in/" style="color:rgb(17,85,204)" target="_blank">www.orisys.in</a>​</span></td></tr><tr><td><div style="font-family:verdana,sans-serif;display:inline">​   Blog  :​</div></td><td><div style="font-family:verdana,sans-serif;display:inline">​<a href="http://www.orisys.in/blog" style="color:rgb(17,85,204)" target="_blank">www.orisys.in/blog</a></div></td></tr></tbody></table></td></tr></tbody></table><div style="color:rgb(34,34,34);font-size:12.8px;line-height:normal"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:Arial,Helvetica,sans-serif;font-size:9pt;color:rgb(50,50,50)"><tbody><tr><td style="border-bottom:1px solid rgb(200,200,200)"><br></td></tr></tbody></table></div><div style="color:rgb(34,34,34);font-size:12.8px;line-height:normal"><div style="font-family:verdana,sans-serif"><div> <br></div><font color="#666666" style="font-size:x-small"><div style="text-align:center"><span style="font-size:small"></span></div></font><font color="#666666" style="font-size:x-small"><div style="text-align:center"><div style="text-align:left">Disclaimer : This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify us. This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.</div></div></font></div></div></td></tr><tr><td><br></td></tr></tbody></table></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>
</div>',
                'received_date' => '2017-10-20 12:59:01',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-10-20 13:00:10',
                'updated_at' => '2018-10-15 10:58:26',
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'id' => 134,
                'cmpny_id' => 2,
                'email_id' => 0,
                'thread_id' => 53,
                'from' => 'oriesmarti@gmail.com',
                'from_name' => 'KSFE <oriesmarti@gmail.com>',
                'subject' => 'hai',
                'message' => 'ചിട്ടിയി;ല്‍ എങ്ങനെ ചേരാം ?',
                'received_date' => '2017-10-20 13:01:06',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-10-20 13:01:06',
                'updated_at' => '2018-10-15 10:58:26',
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'id' => 135,
                'cmpny_id' => 2,
                'email_id' => 0,
                'thread_id' => 11,
                'from' => 'oriesmarti@gmail.com',
                'from_name' => 'KSFE <oriesmarti@gmail.com>',
                'subject' => 'test mail',
                'message' => 'test',
                'received_date' => '2017-11-16 14:17:47',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-11-16 14:17:47',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'id' => 136,
                'cmpny_id' => 2,
                'email_id' => 0,
                'thread_id' => 11,
                'from' => 'oriesmarti@gmail.com',
                'from_name' => 'KSFE <oriesmarti@gmail.com>',
                'subject' => 'test mail',
                'message' => 'test123',
                'received_date' => '2017-11-16 14:18:52',
                'submit_status' => 0,
                'read_status' => 1,
                'answered' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-11-16 14:18:52',
                'updated_at' => '2018-10-15 11:14:42',
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'id' => 137,
                'cmpny_id' => 2,
                'email_id' => 0,
                'thread_id' => 11,
                'from' => 'oriesmarti@gmail.com',
                'from_name' => 'KSFE <oriesmarti@gmail.com>',
                'subject' => 'SECURITIES GENERALLY ACCEPTED BY THE KSFE',
                'message' => '<p></p>
<p>Dear&nbsp;[[ First Name ]],</p>
<p></p>
<p>As you requested, please see the details below&nbsp;</p>
<p></p>
<p><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong>SECURITIES GENERALLY ACCEPTED BY THE&nbsp;<i>KSFE</i></strong></span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>The&nbsp;<b>K</b>erala&nbsp;<b>S</b>tate&nbsp;<b>F</b>inancial&nbsp;<b>E</b>nterprises offers financial assistance under various Schemes. These schemes are listed below:<br><br>&nbsp;&nbsp;&nbsp;<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span color="#006600" style="color: #006600;">Chitty Loan<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Consumer/Vehicle Loan</span></strong></span></p>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Special Car Loan</span></strong></span><span color="#006600" style="color: #006600;"><br><br></span></strong></span><span color="#006600" style="color: #006600;"><strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;KSFE Personal Loan</span></strong></span></p>
<div align="justify">
<p><span color="#006600" style="color: #006600;"><strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Gold Loan<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Trade Finance</span></strong></span></p>
<p><span color="#006600" style="color: #006600;"><strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Flexy Trade Loan</span></strong><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; KSFE Housing Loan<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pass Book Loan<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fixed Deposit Loan</span></strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;</span></span><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br>In addition to the above, the&nbsp;<strong>Chitty Scheme</strong>, which is the backbone of the Company, has an advance aspect built into it. The payment of prize money in chitties is actually an advance given to the subscriber by the Company.</span></p>
</div>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">Advances under all the above mentioned schemes can be made only against security of one type or the other, so as to ensure the repayment of the advance, along with interest. Thus in the context of&nbsp;<b><i>KSFE</i></b>&nbsp;advances, or for that matter; in the context of advances by any other institutions, securities can be defined as follows:</span></p>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">"Anything, such as salary recovery undertaking, landed property, deposit receipts, etc., that is deposited or pledged as a guarantee for the fulfillment of an undertaking regarding the repayment of an advance, along with interest thereon, to be forfeited in case of default".</span></p>
</div>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">The various types of securities accepted by the&nbsp;<b><i>KSFE</i></b>&nbsp;for its different schemes are the following:</span></p>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span color="#006600" style="color: #006600;">&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para1">&nbsp;Personal Security&nbsp;</a></span></strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">(Not applicable to Flexy Trade Loan and Special Car Loan</span><span color="#006600" style="color: #006600;">)<br></span><strong><span color="#006600" style="color: #006600;"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para2">Fixed Deposits of KSFE and Other Bank Deposits</a></span></strong></span></p>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para3">Short Term Deposits of KSFE</a></span></strong></span></strong></span></p>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deposit-in-Trust of KSFE</span></strong></span></strong></span></p>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para4">&nbsp;L.I.C. Policy</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para5">Bank Guarantee</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para6">&nbsp;Pass Book of Non-prized Chitties of KSFE</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para7">National Savings Certificates VIII Issue</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para8" target="_self">Kissan Vikas Patra</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para9">NRI Deposits</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para10">Property Security</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para11">Gold Ornaments</a></span></strong></span></p>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para12">Sugama Security&nbsp;</a></span></strong></span><span color="#006600" style="color: #006600;"><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para13">Combined Security</a></span></strong></span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>Details regarding these securities and an outline of &nbsp;&nbsp;the documentation involved are given below:<br><br><strong><span color="#006600" style="color: #006600;"><a name="para1"></a>PERSONAL SECURITY&nbsp;</span></strong></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b>&nbsp;</b><br><br>Personal security is accepted for future liability upto Rs.12-lakhs. Employees of Central/ State/ Quasi-Government Departments/ Undertakings, employees of Government / Aided schools/ Plus two schools, colleges and employees of Nationalised/ Scheduled Banks and certain Co-operative institutions are generally accepted as sureties by the Company for&nbsp; its various schemes.&nbsp;<br></span></p>
</div>
<p><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b>1. SALARY AND MINIMUM SALARY</b></span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;salary&rdquo; for this purpose include Basic pay plus D.A. (Dearness Allowance) and adhoc DA/increase and P.P (Personal Pay), if any.</span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>b)&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;Minimum Salary"</span><br><br><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp; Only full-time permanent employees who are drawing a minimum net-salary&nbsp; of Rs.5000/- will be accepted as sureties/guarantors.</span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><span color="#006600" style="color: #006600;">2. CLASSIFICATION OF SURETIES</span></b></span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;SREG&rdquo; (Salary Recovery Enforceable Group)<br><br></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">b)&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;SRNEG (Salary Recovery Non-Enforceable Group)</span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><br><br><span color="#006600" style="color: #006600;">3. Salary Requirement Norms&nbsp;</span></b></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SREG employees:The SREG surety (s)/guarantor(s) offered should have a minimum/combined salary of 10% of the future liability.<br><br>b)&nbsp; &nbsp;SRNEG employees:<br><br>The SRNEG surety(s)/guarantor(s) offered should have a minimum/combined salary of 12.5% of the future liability.<br><br>c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;Combination of Sureties/guarantors<br><br>When SREG employee and SRNEG employee are jointly offered as sureties/ guarantors they should have a combined minimum salary of 12.5% of the future liability.</span></p>
<div align="justify">
<p><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b>4.&nbsp; General Conditions.</b></span><br><br><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">(a)&nbsp;&nbsp; Sureties should be permanent residents of and working in Kerala State.<br><br>(b)&nbsp; They should be permanent/ officiating full time employees.<br><br>(c)&nbsp; The sureties should have at least&nbsp; 6 months service left for retirement after the termination of&nbsp; the period of liability.<br><br><strong><span color="#006600" style="color: #006600;">SELF SURETY</span></strong></span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>SREG and SRNEG employees who are chitty subscribers/Loanees can avail of the facility of self surety/guarantee, up to a liability of Rs.3,00,000/- in all schemes, with minimum net-salary of Rs.5000/- on the condition that total recovery of the applicant doesnot exceed 60% including the monthly gross instalment amount of the chitty/loan/advance applied for. However for future liability upto Rs.4,00,000/- ,personal surety is accepted on the basis of salary certificate as well as marks as per score card.<br></span></p>
</div>
<div align="justify">
<p><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong>SINGLE SURETY<br></strong></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><br></strong>Single surety is accepted in all the schemes:<br><br></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">(a) Upto a liability of Rs. 300,000/- if the principal debtor is unemployed, provided the surety is from SREG with minimum net-salary of Rs.5000/-.on the condition that total recovery of the surety doesnot exceed 60% including the monthly gross instalment of the chitty/loan/advance applied for.<br><br></span></p>
</div>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">(b) Upto a liability of Rs.700000/-, where the principal debtor is from SREG, provided both the principal debtor and surety have separate minimum net-salary of Rs.5000/-.on the condition that total recovery of the principal debtor doesnot exceed 60% including the monthly gross instalment of the chitty/loan/advance applied for.</span></p>
<p>&nbsp;</p>
<p><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong>I.&nbsp;&nbsp;&nbsp;<a name="para2"></a>FIXED DEPOSIT</strong></span><br><br></p>
</div>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">Fixed deposits with Nationalised Banks, Scheduled Banks, District Co-operative Banks, Co-operative Banks or any other Banks, having deposit insurance coverage and fixed deposits with&nbsp;<b><i>KSFE</i></b>. Ltd., either in the name of the subscriber/applicant or in the name of another person will be accepted as security for all our schemes.</span></p>
<p><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong>II.<a name="para3"></a>&nbsp;&nbsp;SHORT TERM DEPOSIT</strong></span><br><br></p>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">Short Term deposits with<b><i>&nbsp;KSFE</i></b>. Ltd., either in the name of the subscriber/applicant or in the name of another person will be accepted as security for all our schemes.</span></p>
</div>
</div>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><span color="#006600" style="color: #006600;"><a name="para4"></a>III.&nbsp;&nbsp; L.I.C POLICY</span><br><br></b></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">LIC Policies, the surrender value of which, are equal to the future liability of the loan/chitty can be accepted as security. The LIC policy accepted as security in such cases can be in the name of applicant/subscriber or in the name of spouse or in the name of any other person. In such cases the policy should be assigned in favour of the company and the policy holder should be a co-bounden in the agreement.</span></p>
</div>
<p><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><a name="para5"></a>IV.&nbsp;BANK GUARANTEE</strong></span><br><br></p>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">Government Securities and Bank Guarantee can be accepted as valid security. The Bank Guarantee should cover an amount equal to one instalment more than the future liability. Also it should be valid for a period not less than three months after the termination of the liability.</span></p>
</div>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;"><a name="para6"></a>V.&nbsp;&nbsp;PASS BOOK OF NON-PRIZED CHITTIES</span></strong></span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>The Passbook of non-prized chitties can be accepted as security for the future liability of schemes.</span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br></span></p>
</div>
<div align="justify"></div>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;"><a name="para7"></a>VI.&nbsp;&nbsp; NATIONAL SAVINGS CERTIFICATE (VIII ISSUE)</span><br><br></strong></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">NSC will be accepted as valid security, on the following conditions:<br><br></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">At the time of acceptance, the issue price (face value) of the NSC&rsquo;s (VIII issue), should cover the future liability, ie. principal plus interest in case of advances and sum total of future instalments in the case of chitties. The interest for the loan amount is to be calculated till the maturity of the instrument or the remaining period of loan, whichever is longer.<br></span></p>
</div>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">Forms prescribed by the Post Office are used for noting the lien.<br><br></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><span color="#006600" style="color: #006600;"><a name="para8"></a>VII.&nbsp;&nbsp;&nbsp;KISSAN VIKAS PATRA</span><br><br></b></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">The future liability for which Kisan Vikas Patra can be accepted as security is determined as follows:</span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>1.&nbsp;&nbsp; In case the Kissan Vikas Patra is offered as security before the expiry of 30 months after the issue of the&nbsp;&nbsp;&nbsp; same, the certificate will be accepted for a future liability not exceeding 75% of the value of the certificate (i.e, purchase price).</span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br clear="all"></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">2.&nbsp; If the Kissan Vikas Patra is offered as security after 30 months (i.e, expiry of lock in period) of the issue of the same, the certificate will be accepted as security for future liability worth the premature closure value of the certificate on the date of acceptance of the same as security.<br></span></p>
</div>
<div align="justify">
<p><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><a name="para9"></a>VIII.&nbsp;&nbsp; N.R.I. DEPOSITS</strong></span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>The NRI, NRO, FCNR and NRNR deposits can be accepted as security to our various schemes, provided.</span></p>
</div>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br>a)&nbsp; The deposit receipts are properly discharged and company&rsquo;s lien noted on it.<br></span></p>
</div>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">b)&nbsp; The Bank, in which the&nbsp; deposit is kept, agrees to close it and make required payment to&nbsp;&nbsp;&nbsp;<b><i>KSFE</i></b>. even &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;before maturity, on demand.<br><a name="para10"></a><br></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;">IX.&nbsp;&nbsp;&nbsp; PROPERTY SECURITY</span><br><br></strong></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">Property security inside the State of Kerala can be accepted as security, provided the title of the owner over the property is clear. The following documents will have to be presented while submitting property as security.</span>&nbsp;<br><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Title Deeds and prior documents in original (for the past 13 years)</span></strong></span><span color="#006600" style="color: #006600;"><strong><br><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Encumbrance certificate for the past 13 years</span><br><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Land Tax Receipt for the current year</span><br><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Building Tax Receipt, if there is a building on the property.&nbsp;</span><br><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Possession and enjoyment certificate</span><br><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Location Certificate and Sketch of the property.</span></strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"></span></span></p>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;"><a name="para11"></a>X.&nbsp;&nbsp;&nbsp; GOLD SECURITY</span></strong></span></p>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">Gold ornaments can be accepted as security towards future liablity in all schemes.</span></p>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;"><a name="para12"></a>XI.&nbsp;&nbsp;&nbsp; SUGAMA SECURITY</span></strong></span></p>
<p><strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#006600" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"></span></strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">Outstanding balance in Sugama account can be accepted as security for future liability in chitty/loan schemes. The deposit amount should at least cover the future liability. For the balance in Sugama Security account, interest @ 5.5% will be allowed. Monthly instalment can be adjusted from the account. The main advantage of the scheme is that the customer can release his documents pledged and also earn interest on the amount outstanding in this account.</span></p>
</div>
<div align="justify">
<p><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><a name="para13"></a>XII.&nbsp;&nbsp;&nbsp;COMBINED SECURITY</strong></span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>A subscriber/loanee is allowed to offer one or more types of acceptable security at a time, in combination, subject to certain rules and regulations.</span></p>
</div>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><span color="#006600" style="color: #006600;">Norms for our Schemes</span><br><br></b></span></p>
<table border="1" align="center" cellpadding="0" cellspacing="0">
<tbody>
<tr valign="middle" bgcolor="#D9FFF2">
<td width="66" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b>a.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>&nbsp;</span></td>
<td class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><a href="http://www.ksfe.com/chitty.htm">Chitty</a></b></span></td>
<td width="304" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">10% of future liability (instalments to be remitted) in the case of&nbsp;&nbsp; SREG, 12.5% of future liability in the case of SRNEG and SREG/SRNEG combination.</span></td>
</tr>
<tr valign="middle" bgcolor="#D9FFF2">
<td width="66" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">b.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></td>
<td class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><a href="http://www.ksfe.com/chittyloan.htm">New Chitty Loan</a></b></span></td>
<td width="304" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">10% of loan amount in case of SREG, 12.5% of future liability in the case of SRNEG and SREG/SRNEG combination</span></td>
</tr>
<tr valign="middle" bgcolor="#D9FFF2">
<td width="66" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">c.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></td>
<td class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><a href="http://www.ksfe.com/vechile.htm">Consumer/ Vehicle Loan</a></b></span></td>
<td width="304" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">10% of future liability (Advance + Finance charge) in the case of SREG, 12.5% of future liability in the case of SRNEG and SREG/SRNEG combination</span></td>
</tr>
<tr valign="middle" bgcolor="#D9FFF2">
<td width="66" height="24" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">d.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></td>
<td class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><a href="http://www.ksfe.com/trade.htm">Trade Financing Scheme</a></b></span>&nbsp;<span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;</span></td>
<td width="304" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">10% of loan amount of SREG sureties.</span></td>
</tr>
<tr valign="middle" bgcolor="#D9FFF2">
<td width="66" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">e.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></td>
<td class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><a href="http://www.ksfe.com/customer.htm">Reliable Customer Loan</a></b></span>&nbsp;<span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;</span></td>
<td width="304" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">The amount to be secured under RCL will be the future liability i.e. principal plus interest. There are no separate security norms.</span></td>
</tr>
</tbody>
</table>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">The security norms in vogue are applicable. However mutual surety will not be accepted.&nbsp; In the case of immovable property immovable property valuation is half times of the market value..</span></p>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">The applicant should execute a loan agreement on stamp paper worth Rs.200/- in the prescribed format.</span></p>
</div>',
            'received_date' => '2017-11-17 15:35:19',
            'submit_status' => 0,
            'read_status' => 1,
            'answered' => NULL,
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => '2017-11-17 15:35:19',
            'updated_at' => '2018-10-15 11:14:42',
            'deleted_at' => NULL,
        ),
        63 => 
        array (
            'id' => 138,
            'cmpny_id' => 2,
            'email_id' => 0,
            'thread_id' => 11,
            'from' => 'oriesmarti@gmail.com',
            'from_name' => 'KSFE <oriesmarti@gmail.com>',
            'subject' => 'test',
            'message' => '<p><span>Hi Arun Jaganathan <arun.jaganathan@orisys.in></span></p>
<p><span></span></p>
<p><span></span></p>
<table border="1" style="border-color: #4c4c4c; width: 100%;">
<tbody>
<tr><th>Chit Name</th><th>Amount</th><th>Installment</th><th>Sub Amount</th><th>Announce Date</th><th>Duration</th></tr>
<tr>
<td>KSFE NRI CHIT17</td>
<td>900000.00</td>
<td>90</td>
<td>10000</td>
<td>10/10/2018</td>
<td>Monthly</td>
</tr>
</tbody>
</table>',
            'received_date' => '2017-11-17 15:43:56',
            'submit_status' => 0,
            'read_status' => 1,
            'answered' => NULL,
            'created_by' => NULL,
            'updated_by' => NULL,
            'created_at' => '2017-11-17 15:43:56',
            'updated_at' => '2018-10-15 11:14:42',
            'deleted_at' => NULL,
        ),
        64 => 
        array (
            'id' => 139,
            'cmpny_id' => 2,
            'email_id' => 0,
            'thread_id' => 53,
            'from' => 'oriesmarti@gmail.com',
            'from_name' => 'KSFE <oriesmarti@gmail.com>',
            'subject' => 'SECURITIES GENERALLY ACCEPTED BY THE KSFE  updated',
            'message' => '<p></p>
<p>Dear&nbsp;Devika Devarajan <devika.devarajan@orisys.in>,</p>
<p></p>
<p>As you requested, please see the details below&nbsp;</p>
<p></p>
<p><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong>SECURITIES GENERALLY ACCEPTED BY THE&nbsp;<i>KSFE</i></strong></span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>The&nbsp;<b>K</b>erala&nbsp;<b>S</b>tate&nbsp;<b>F</b>inancial&nbsp;<b>E</b>nterprises offers financial assistance under various Schemes. These schemes are listed below:<br><br>&nbsp;&nbsp;&nbsp;<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span color="#006600" style="color: #006600;">Chitty Loan<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Consumer/Vehicle Loan</span></strong></span></p>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Special Car Loan</span></strong></span><span color="#006600" style="color: #006600;"><br><br></span></strong></span><span color="#006600" style="color: #006600;"><strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;KSFE Personal Loan</span></strong></span></p>
<div align="justify">
<p><span color="#006600" style="color: #006600;"><strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Gold Loan<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Trade Finance</span></strong></span></p>
<p><span color="#006600" style="color: #006600;"><strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Flexy Trade Loan</span></strong><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; KSFE Housing Loan<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pass Book Loan<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fixed Deposit Loan</span></strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;</span></span><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br>In addition to the above, the&nbsp;<strong>Chitty Scheme</strong>, which is the backbone of the Company, has an advance aspect built into it. The payment of prize money in chitties is actually an advance given to the subscriber by the Company.</span></p>
</div>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">Advances under all the above mentioned schemes can be made only against security of one type or the other, so as to ensure the repayment of the advance, along with interest. Thus in the context of&nbsp;<b><i>KSFE</i></b>&nbsp;advances, or for that matter; in the context of advances by any other institutions, securities can be defined as follows:</span></p>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">"Anything, such as salary recovery undertaking, landed property, deposit receipts, etc., that is deposited or pledged as a guarantee for the fulfillment of an undertaking regarding the repayment of an advance, along with interest thereon, to be forfeited in case of default".</span></p>
</div>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">The various types of securities accepted by the&nbsp;<b><i>KSFE</i></b>&nbsp;for its different schemes are the following:</span></p>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span color="#006600" style="color: #006600;">&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para1">&nbsp;Personal Security&nbsp;</a></span></strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">(Not applicable to Flexy Trade Loan and Special Car Loan</span><span color="#006600" style="color: #006600;">)<br></span><strong><span color="#006600" style="color: #006600;"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para2">Fixed Deposits of KSFE and Other Bank Deposits</a></span></strong></span></p>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para3">Short Term Deposits of KSFE</a></span></strong></span></strong></span></p>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deposit-in-Trust of KSFE</span></strong></span></strong></span></p>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para4">&nbsp;L.I.C. Policy</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para5">Bank Guarantee</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para6">&nbsp;Pass Book of Non-prized Chitties of KSFE</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para7">National Savings Certificates VIII Issue</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para8" target="_self">Kissan Vikas Patra</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para9">NRI Deposits</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para10">Property Security</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para11">Gold Ornaments</a></span></strong></span></p>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para12">Sugama Security&nbsp;</a></span></strong></span><span color="#006600" style="color: #006600;"><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ksfe.com/securities.htm#para13">Combined Security</a></span></strong></span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>Details regarding these securities and an outline of &nbsp;&nbsp;the documentation involved are given below:<br><br><strong><span color="#006600" style="color: #006600;"><a name="para1"></a>PERSONAL SECURITY&nbsp;</span></strong></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b>&nbsp;</b><br><br>Personal security is accepted for future liability upto Rs.12-lakhs. Employees of Central/ State/ Quasi-Government Departments/ Undertakings, employees of Government / Aided schools/ Plus two schools, colleges and employees of Nationalised/ Scheduled Banks and certain Co-operative institutions are generally accepted as sureties by the Company for&nbsp; its various schemes.&nbsp;<br></span></p>
</div>
<p><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b>1. SALARY AND MINIMUM SALARY</b></span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;salary&rdquo; for this purpose include Basic pay plus D.A. (Dearness Allowance) and adhoc DA/increase and P.P (Personal Pay), if any.</span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>b)&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;Minimum Salary"</span><br><br><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp; Only full-time permanent employees who are drawing a minimum net-salary&nbsp; of Rs.5000/- will be accepted as sureties/guarantors.</span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><span color="#006600" style="color: #006600;">2. CLASSIFICATION OF SURETIES</span></b></span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;SREG&rdquo; (Salary Recovery Enforceable Group)<br><br></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">b)&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;SRNEG (Salary Recovery Non-Enforceable Group)</span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><br><br><span color="#006600" style="color: #006600;">3. Salary Requirement Norms&nbsp;</span></b></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SREG employees:The SREG surety (s)/guarantor(s) offered should have a minimum/combined salary of 10% of the future liability.<br><br>b)&nbsp; &nbsp;SRNEG employees:<br><br>The SRNEG surety(s)/guarantor(s) offered should have a minimum/combined salary of 12.5% of the future liability.<br><br>c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;Combination of Sureties/guarantors<br><br>When SREG employee and SRNEG employee are jointly offered as sureties/ guarantors they should have a combined minimum salary of 12.5% of the future liability.</span></p>
<div align="justify">
<p><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b>4.&nbsp; General Conditions.</b></span><br><br><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">(a)&nbsp;&nbsp; Sureties should be permanent residents of and working in Kerala State.<br><br>(b)&nbsp; They should be permanent/ officiating full time employees.<br><br>(c)&nbsp; The sureties should have at least&nbsp; 6 months service left for retirement after the termination of&nbsp; the period of liability.<br><br><strong><span color="#006600" style="color: #006600;">SELF SURETY</span></strong></span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>SREG and SRNEG employees who are chitty subscribers/Loanees can avail of the facility of self surety/guarantee, up to a liability of Rs.3,00,000/- in all schemes, with minimum net-salary of Rs.5000/- on the condition that total recovery of the applicant doesnot exceed 60% including the monthly gross instalment amount of the chitty/loan/advance applied for. However for future liability upto Rs.4,00,000/- ,personal surety is accepted on the basis of salary certificate as well as marks as per score card.<br></span></p>
</div>
<div align="justify">
<p><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong>SINGLE SURETY<br></strong></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><br></strong>Single surety is accepted in all the schemes:<br><br></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">(a) Upto a liability of Rs. 300,000/- if the principal debtor is unemployed, provided the surety is from SREG with minimum net-salary of Rs.5000/-.on the condition that total recovery of the surety doesnot exceed 60% including the monthly gross instalment of the chitty/loan/advance applied for.<br><br></span></p>
</div>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">(b) Upto a liability of Rs.700000/-, where the principal debtor is from SREG, provided both the principal debtor and surety have separate minimum net-salary of Rs.5000/-.on the condition that total recovery of the principal debtor doesnot exceed 60% including the monthly gross instalment of the chitty/loan/advance applied for.</span></p>
<p>&nbsp;</p>
<p><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong>I.&nbsp;&nbsp;&nbsp;<a name="para2"></a>FIXED DEPOSIT</strong></span><br><br></p>
</div>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">Fixed deposits with Nationalised Banks, Scheduled Banks, District Co-operative Banks, Co-operative Banks or any other Banks, having deposit insurance coverage and fixed deposits with&nbsp;<b><i>KSFE</i></b>. Ltd., either in the name of the subscriber/applicant or in the name of another person will be accepted as security for all our schemes.</span></p>
<p><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong>II.<a name="para3"></a>&nbsp;&nbsp;SHORT TERM DEPOSIT</strong></span><br><br></p>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">Short Term deposits with<b><i>&nbsp;KSFE</i></b>. Ltd., either in the name of the subscriber/applicant or in the name of another person will be accepted as security for all our schemes.</span></p>
</div>
</div>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><span color="#006600" style="color: #006600;"><a name="para4"></a>III.&nbsp;&nbsp; L.I.C POLICY</span><br><br></b></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">LIC Policies, the surrender value of which, are equal to the future liability of the loan/chitty can be accepted as security. The LIC policy accepted as security in such cases can be in the name of applicant/subscriber or in the name of spouse or in the name of any other person. In such cases the policy should be assigned in favour of the company and the policy holder should be a co-bounden in the agreement.</span></p>
</div>
<p><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><a name="para5"></a>IV.&nbsp;BANK GUARANTEE</strong></span><br><br></p>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">Government Securities and Bank Guarantee can be accepted as valid security. The Bank Guarantee should cover an amount equal to one instalment more than the future liability. Also it should be valid for a period not less than three months after the termination of the liability.</span></p>
</div>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;"><a name="para6"></a>V.&nbsp;&nbsp;PASS BOOK OF NON-PRIZED CHITTIES</span></strong></span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>The Passbook of non-prized chitties can be accepted as security for the future liability of schemes.</span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br></span></p>
</div>
<div align="justify"></div>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;"><a name="para7"></a>VI.&nbsp;&nbsp; NATIONAL SAVINGS CERTIFICATE (VIII ISSUE)</span><br><br></strong></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">NSC will be accepted as valid security, on the following conditions:<br><br></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">At the time of acceptance, the issue price (face value) of the NSC&rsquo;s (VIII issue), should cover the future liability, ie. principal plus interest in case of advances and sum total of future instalments in the case of chitties. The interest for the loan amount is to be calculated till the maturity of the instrument or the remaining period of loan, whichever is longer.<br></span></p>
</div>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">Forms prescribed by the Post Office are used for noting the lien.<br><br></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><span color="#006600" style="color: #006600;"><a name="para8"></a>VII.&nbsp;&nbsp;&nbsp;KISSAN VIKAS PATRA</span><br><br></b></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">The future liability for which Kisan Vikas Patra can be accepted as security is determined as follows:</span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>1.&nbsp;&nbsp; In case the Kissan Vikas Patra is offered as security before the expiry of 30 months after the issue of the&nbsp;&nbsp;&nbsp; same, the certificate will be accepted for a future liability not exceeding 75% of the value of the certificate (i.e, purchase price).</span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br clear="all"></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">2.&nbsp; If the Kissan Vikas Patra is offered as security after 30 months (i.e, expiry of lock in period) of the issue of the same, the certificate will be accepted as security for future liability worth the premature closure value of the certificate on the date of acceptance of the same as security.<br></span></p>
</div>
<div align="justify">
<p><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><a name="para9"></a>VIII.&nbsp;&nbsp; N.R.I. DEPOSITS</strong></span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>The NRI, NRO, FCNR and NRNR deposits can be accepted as security to our various schemes, provided.</span></p>
</div>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br>a)&nbsp; The deposit receipts are properly discharged and company&rsquo;s lien noted on it.<br></span></p>
</div>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">b)&nbsp; The Bank, in which the&nbsp; deposit is kept, agrees to close it and make required payment to&nbsp;&nbsp;&nbsp;<b><i>KSFE</i></b>. even &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;before maturity, on demand.<br><a name="para10"></a><br></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;">IX.&nbsp;&nbsp;&nbsp; PROPERTY SECURITY</span><br><br></strong></span><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">Property security inside the State of Kerala can be accepted as security, provided the title of the owner over the property is clear. The following documents will have to be presented while submitting property as security.</span>&nbsp;<br><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Title Deeds and prior documents in original (for the past 13 years)</span></strong></span><span color="#006600" style="color: #006600;"><strong><br><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Encumbrance certificate for the past 13 years</span><br><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Land Tax Receipt for the current year</span><br><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Building Tax Receipt, if there is a building on the property.&nbsp;</span><br><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Possession and enjoyment certificate</span><br><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Location Certificate and Sketch of the property.</span></strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"></span></span></p>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;"><a name="para11"></a>X.&nbsp;&nbsp;&nbsp; GOLD SECURITY</span></strong></span></p>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">Gold ornaments can be accepted as security towards future liablity in all schemes.</span></p>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><span color="#006600" style="color: #006600;"><a name="para12"></a>XI.&nbsp;&nbsp;&nbsp; SUGAMA SECURITY</span></strong></span></p>
<p><strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#006600" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"></span></strong><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">Outstanding balance in Sugama account can be accepted as security for future liability in chitty/loan schemes. The deposit amount should at least cover the future liability. For the balance in Sugama Security account, interest @ 5.5% will be allowed. Monthly instalment can be adjusted from the account. The main advantage of the scheme is that the customer can release his documents pledged and also earn interest on the amount outstanding in this account.</span></p>
</div>
<div align="justify">
<p><span color="#006600" size="1" face="Verdana, Arial, Helvetica, sans-serif" style="color: #006600; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><strong><a name="para13"></a>XII.&nbsp;&nbsp;&nbsp;COMBINED SECURITY</strong></span>&nbsp;<span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><br><br>A subscriber/loanee is allowed to offer one or more types of acceptable security at a time, in combination, subject to certain rules and regulations.</span></p>
</div>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><span color="#006600" style="color: #006600;">Norms for our Schemes</span><br><br></b></span></p>
<table border="1" align="center" cellpadding="0" cellspacing="0">
<tbody>
<tr valign="middle" bgcolor="#D9FFF2">
<td width="66" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b>a.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>&nbsp;</span></td>
<td class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><a href="http://www.ksfe.com/chitty.htm">Chitty</a></b></span></td>
<td width="304" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">10% of future liability (instalments to be remitted) in the case of&nbsp;&nbsp; SREG, 12.5% of future liability in the case of SRNEG and SREG/SRNEG combination.</span></td>
</tr>
<tr valign="middle" bgcolor="#D9FFF2">
<td width="66" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">b.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></td>
<td class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><a href="http://www.ksfe.com/chittyloan.htm">New Chitty Loan</a></b></span></td>
<td width="304" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">10% of loan amount in case of SREG, 12.5% of future liability in the case of SRNEG and SREG/SRNEG combination</span></td>
</tr>
<tr valign="middle" bgcolor="#D9FFF2">
<td width="66" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">c.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></td>
<td class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><a href="http://www.ksfe.com/vechile.htm">Consumer/ Vehicle Loan</a></b></span></td>
<td width="304" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">10% of future liability (Advance + Finance charge) in the case of SREG, 12.5% of future liability in the case of SRNEG and SREG/SRNEG combination</span></td>
</tr>
<tr valign="middle" bgcolor="#D9FFF2">
<td width="66" height="24" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">d.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></td>
<td class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><a href="http://www.ksfe.com/trade.htm">Trade Financing Scheme</a></b></span>&nbsp;<span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;</span></td>
<td width="304" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">10% of loan amount of SREG sureties.</span></td>
</tr>
<tr valign="middle" bgcolor="#D9FFF2">
<td width="66" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">e.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></td>
<td class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"><b><a href="http://www.ksfe.com/customer.htm">Reliable Customer Loan</a></b></span>&nbsp;<span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">&nbsp;</span></td>
<td width="304" class="Normal"><span size="1" face="Verdana, Arial, Helvetica, sans-serif" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">The amount to be secured under RCL will be the future liability i.e. principal plus interest. There are no separate security norms.</span></td>
</tr>
</tbody>
</table>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">The security norms in vogue are applicable. However mutual surety will not be accepted.&nbsp; In the case of immovable property immovable property valuation is half times of the market value..</span></p>
<div align="justify">
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">The applicant should execute a loan agreement on stamp paper worth Rs.200/- in the prescribed format.</span></p>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;">Devika Devarajan <devika.devarajan@orisys.in></span></p>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"></span></p>
<table border="1" style="border-color: #4c4c4c; width: 100%;">
<tbody>
<tr><th>Chit Name</th><th>Amount</th><th>Installment</th><th>Sub Amount</th><th>Announce Date</th><th>Duration</th></tr>
<tr>
<td>NRI CHIT17/22</td>
<td>360000.00</td>
<td>36</td>
<td>10000</td>
<td>10/10/2018</td>
<td>Monthly</td>
</tr>
</tbody>
</table>
<p><span face="Verdana, Arial, Helvetica, sans-serif" size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small;"></span></p>
</div>',
        'received_date' => '2017-11-21 12:29:24',
        'submit_status' => 0,
        'read_status' => 1,
        'answered' => NULL,
        'created_by' => NULL,
        'updated_by' => NULL,
        'created_at' => '2017-11-21 12:29:24',
        'updated_at' => '2018-10-15 10:58:26',
        'deleted_at' => NULL,
    ),
    65 => 
    array (
        'id' => 140,
        'cmpny_id' => 2,
        'email_id' => 0,
        'thread_id' => 53,
        'from' => 'oriesmarti@gmail.com',
        'from_name' => 'KSFE <oriesmarti@gmail.com>',
        'subject' => 'I hear that now a days KSFE Chitty scheme opens its door to NRI\'s also?',
        'message' => '<p><span>Yes. Now NRI\'s can also join chitties offered by KSFE as per notification no. 227 dated 13/4/2015 in the gazette of government of India. For this, they may go through the various denominations of chitties offered by our various Branches and select the type for their requirement. Then they may download the chitty application form, which can be obtained from our website. Take the printout in duplicate and fill up the personal details called for in the last page of the application form. After putting signature on both forms, they may send them to the concerned branches. The address and phone number of branches are provided in our website. The amount for first installment may be transferred by the mode internet banking, money transfer service of WUMT/Xpress Money, for which KSFE has an agreement. The installment can also be remitted directly in the branch in cash/cheque on behalf of the subscriber. For internet banking, the account no. and IFSC code of the branches may be obtained by contacting the concerned branch over phone or email.</span></p>',
        'received_date' => '2017-11-21 12:43:16',
        'submit_status' => 0,
        'read_status' => 1,
        'answered' => NULL,
        'created_by' => NULL,
        'updated_by' => NULL,
        'created_at' => '2017-11-21 12:43:16',
        'updated_at' => '2018-10-15 10:58:26',
        'deleted_at' => NULL,
    ),
    66 => 
    array (
        'id' => 141,
        'cmpny_id' => 2,
        'email_id' => 0,
        'thread_id' => 53,
        'from' => 'oriesmarti@gmail.com',
        'from_name' => 'KSFE <oriesmarti@gmail.com>',
        'subject' => 'I hear that now a days KSFE Chitty scheme opens its door to NRI\'s also?',
        'message' => '<p>Hi&nbsp;Devika Devarajan <devika.devarajan@orisys.in></p>
<p>Yes. Now NRI\'s can also join chitties offered by KSFE as per notification no. 227 dated 13/4/2015 in the gazette of government of India. For this, they may go through the various denominations of chitties offered by our various Branches and select the type for their requirement. Then they may download the chitty application form, which can be obtained from our website. Take the printout in duplicate and fill up the personal details called for in the last page of the application form. After putting signature on both forms, they may send them to the concerned branches. The address and phone number of branches are provided in our website. The amount for first installment may be transferred by the mode internet banking, money transfer service of WUMT/Xpress Money, for which KSFE has an agreement. The installment can also be remitted directly in the branch in cash/cheque on behalf of the subscriber. For internet banking, the account no. and IFSC code of the branches may be obtained by contacting the concerned branch over phone or email.</p>
<p>Thank You</p>
<p>Devika Devarajan <devika.devarajan@orisys.in> Devika Devarajan <devika.devarajan@orisys.in>&nbsp;</p>',
        'received_date' => '2017-11-21 12:49:33',
        'submit_status' => 0,
        'read_status' => 1,
        'answered' => NULL,
        'created_by' => NULL,
        'updated_by' => NULL,
        'created_at' => '2017-11-21 12:49:33',
        'updated_at' => '2018-10-15 10:58:26',
        'deleted_at' => NULL,
    ),
));
        
        
    }
}