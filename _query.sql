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
    'ressort', json_object('_ref', 'dagebuell', '_type', 'ressort') 
    )
    

from dagebuell_reservations r 
order by created_at desc;
select json_object(
    '_id', 'dagebuell',
    '_type', 'ressort',
    'name', 'Lodge dagebuell'
)  from dual;