
echo O primeiro parâmetro foi: $1 
echo O segundo parâmetro foi: $2
mysql --quick -u root -p --password=producaodataweb --database=dataWebProducao --host=prosp.chl209etmtnz.sa-east-1.rds.amazonaws.com --port=3306 --batch -e "select * from $1" | sed 's/\t/"|"/g;s/^/"/;s/$/"/;s/\n//g;s/NULL//g' > $2 


