-- CREATE OR REPLACE VIEW sites as select id, descr, l, r from kyff_structure where site_id=9 and descr like 'www%';
-- CREATE OR REPLACE VIEW structures as select id, descr, l, r, COALESCE((select descr from sites where (l<s.l and r>s.r) or (l=s.l and r=s.r)), 'www.lotsenturm-usedom.de') as site from kyff_structure s where site_id=9;

select row_to_json(t)
from
    (select descr as _id, 'site' as _type, 
    (SELECT array_to_json(array_agg(n)) FROM (SELECT 'n'|| id as _ref, 'menuitem' as _type from structures s where s.site=sites.descr) as n) as navigation, 
    * from sites) as t;

select
    row_to_json (t)
from
    (
        select
            'menuitem' as _type,
            'n' || id as _id,
            *,
            json_object (array['_ref', '_type'], array[site,'site']) as site
        from
            structures
    ) as t;

select
    row_to_json (t)
from
    (
        select
            'article' as _type,
            'a' || id as _id,
            created_at as _createdAt,
            modified_at as _updatedAt,
            json_object (array['_ref', '_type'], array[(select site from structures where id=art.str_id),'site']) as site,
            json_object (array['_ref', '_type'], array['n'||str_id,'menuitem']) as menu,
            *
        from
            kyff_articles art
        where
            site_id = 9
    ) as t;