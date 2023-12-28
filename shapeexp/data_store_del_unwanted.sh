for dir in DataStore/*;
do
(cd $dir && rm *.csv)
(cd $dir && rm *.png)
done
