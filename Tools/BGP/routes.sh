while :
do
birdc show route all > routes_
birdc6 show route all > routes6_
mv routes_ routes
mv routes6_ routes6
sleep 60
done