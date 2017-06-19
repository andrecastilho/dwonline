
echo O primeiro parâmetro foi: $1
echo O segundo parâmetro foi: $2
mysql --local-infile=1  --quick -u root -p --password=producaodataweb --database=dataWebProducao --host=prosp.chl209etmtnz.sa-east-1.rds.amazonaws.com --port=3306 --batch -e "LOAD DATA LOCAL  INFILE '$1'  INTO TABLE $2 FIELDS TERMINATED BY ','  LINES TERMINATED BY '\n' IGNORE 1 LINES ;"
