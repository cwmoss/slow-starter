<?php

$pwd = $argv[1];
$host = $argv[2];

// id;lname;fname;email;address;address2;city;postalcode;start_date;end_date;created_at;modified_at;paid;pay_type;remarks;status;price;token;pp_payid;pp_token;pp_status;pp_amount;pp_payer
/*

'category', (SELECT  json_object('descr', descr, 'parent', parent, 'seq', seq) from blog_categories c WHERE c.id = e.str_id AND c.blogid = '22e1c726a6b9b1fd782b752c63d7b265'),
    'files', (SELECT json_arrayagg(
        json_object('_id', id, 'name', name, 'origname', origname, 'position', ff.seq, 'ext', ext)
    ) from blog_files f, blog_entry_file ff WHERE ff.eid = e.id AND ff.fid = f.id order by ff.seq),
    'status', status,
    'author', (SELECT json_object('name', uname, 'lname', lname, 'fname', fname, 'email', email) from blog_editors ed WHERE ed.id = e.edi_id),
*/

$sql = <<<'EOD'
select json_object(
    '_id', CONCAT('b.',id), 
    '_type', 'booking', 
    '_createdAt', created_at,
    '_updatedAt', modified_at,
    'booked_at', created_at,
    'lname', lname,
    'fname', fname,
    'email', email,
    'address', address,
    'phone', address2, 
    'city', city,
    'postalcode', postalcode,
    'start_date', start_date,
    'end_date', end_date,
    'paid', paid,
    'pay_type', pay_type,
    'remarks', REPLACE(REPLACE(remarks, '"',''), '\r', ''),
    'status', status,
    'price', price,
    'token', token,
    'paypal', json_object(
        '_type', 'paypal',
        'payid', pp_payid,
        'token', pp_token,
        'status', pp_status,
        'amount', pp_amount, 
        'payer', pp_payer
        ),
    'ressort', json_object('_ref', '%s', '_type', 'ressort') 
    )
    

from %s_reservations r 
order by created_at desc;
select json_object(
    '_id', '%s',
    '_type', 'ressort',
    'name', 'Lodge %s'
)  from dual;
EOD;


$tpl = "cat _query.sql | mysql --default-character-set=utf8 -N -r -uroot -h %s -p%s lodge > %s.jsonl";

$prefix = [
    "wasser" => "wasser",
    "lg" => "usedom",
    "dagebuell" => "dagebuell"
];
$start = "'2024-12-16'";

foreach ($prefix as $p => $name) {

    $query = sprintf($sql, $name, $p, $name, $name);
    file_put_contents("_query.sql", $query);
    $cmd = sprintf($tpl, $host, $pwd, $name);
    print $cmd . "\n";

    `$cmd`;
}
