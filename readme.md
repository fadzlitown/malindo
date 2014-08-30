# Sample Data

feature_categories
id, name

specifications
connectivity
imaging
messaging
storage
entertainment

feature_categories_instances
id, name, feature_category_id

gprs < connectivity
hsdpa < connectivity

feature_categories_instances_metas
id, key, value, feature_category_instance_id

2g, 2G < gprs
3g, 3G < gprs
wcdma, WCDMA < gprs