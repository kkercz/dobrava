################################
# Zestaw reguł zamieniających  #
# słowa z języka dzisiejszego  #
# na prasłowiański             #
################################
#############
# Hacks
^ o j ć e c > ^ o t jm k
^ pi e s > p jm s
################################
LOCSG|sz e $ > x jat $|Druga paltalizacja
LOCSG|c e $ > k jat $|Druga palatalizacja
LOCSG|dz e $ > g jat $|Druga palatalizacja
#################################
cz e > k e|Pierwsza paltalizacja
cz ę > k ę|Pierwsza paltalizacja
cz ą > k ę|Pierwsza paltalizacja
cz y > k i|Pierwsza paltalizacja
cz jm > k jm|Pierwsza paltalizacja
ż e > g e|Pierwsza paltalizacja
ż ę > g ę|Pierwsza paltalizacja
ż y > g i|Pierwsza paltalizacja
ż ą > g ę|Pierwsza paltalizacja
ż jm > g jm|Pierwsza paltalizacja
sz e > x e|Pierwsza paltalizacja
sz ę > x ę|Pierwsza paltalizacja
sz y > x i|Pierwsza paltalizacja
sz ą > x ę|Pierwsza paltalizacja
sz jm > x jm|Pierwsza paltalizacja
###############################
ę c > ę k|Trzecia paltalizacja
jm c > jm k|Trzecia paltalizacja
i c > i k|Trzecia paltalizacja
y c > i k|Trzecia paltalizacja
ę dz > ę g|Trzecia paltalizacja
jm dz > jm g|Trzecia palatalizacja
##############################
k wi a > k v e^|Palatalizacja grup kvě- gvě-
g wi a > g v e^|Palatalizacja grup kvě- gvě-
############################
c a $ > t j a $|Rozwój grup tj-, dj-
dz a $ > d j a $|Rozwój grup tj-, dj-
##########################
^ r o sp > ^ o r sp|rozwój nagłosowych grup ort-, olt-
^ r a sp > ^ o r sp|rozwój nagłosowych grup ort-, olt-
^ ł o sp > ^ o l sp|rozwój nagłosowych grup ort-, olt-
^ ł a sp > ^ o l sp|rozwój nagłosowych grup ort-, olt-
###########################
# śródgłosowe grupy -tort-, -tolt-
# Jak załatwić brzozę (b e r z a)?
# No bo najpierw była metateza a potem przegłos, więc my powinniśmy mieć najpierw przegłos, potem metatezę!
# Czyli: najpierw przegłos, potem reguły :)
^ sp#1 r o sp#2 > ^ sp#1 o r sp#2|rozwój grup tort, tolt
^ sp#1 ł o sp#2 > ^ sp#1 o l sp#2|rozwój grup tort, tolt
########################
^ sp#1 rz e sp#2 > ^ sp#1 e r sp#2|rozwój grup tert, telt
^ sp#1 l e sp#2 > ^ sp#1 e l sp#2|rozwój grup tert, telt
#########################
VERB|ó c > o g t i|rozwój grup kt', gt'
VERB|c > k t i|rozwój grup kt', gt'
c $ > k ti jm|rozwój grup kt', gt'
#####################
#czasowniki
VERB|ć $ > t i $|Prasłowiańska końcówka bezokolicznika
VERB|n ą ć $ > t i $|Prasłowiańska końcówka bezokolicznika
###################
ł > l
w > v
#################
# przymiotniki
ADJ|y $ > jt j jm $|rozwój jerów w sąsiedztwie joty w końcówce przymiotnika
ADJ|i $ > jm j jm $|rozwój jerów w sąsiedztwie joty w końcówce przymiotnika
#################
# jak już nie udało się miękkich inaczej, to musiały być jerem
cz sp > k jm sp|Pierwsza palatalizacja
ż sp > g jm sp|Pierwsza palatalizacja
sz sp > x jm sp|Pierwsza palatalizacja
################
# spółgłoski zmiękczone
pi > p
wi > w
ti > t
fi > f
ki > k
li > l
xi > x
vi > v
bi > b
mi > m
##############
# spółgłoski miękkie, których nie dało się innym sposobem ugryźć
ś o > s e
ć o > t e
ź o > z e
dź o > d e
sz o > x e
rz o > r e
ż o > g e
ch > x
ń o > n e
ó > o|Wzdłużenie zastępcze
dz > g
ś a > s e
ć a > t e
ź a > z e
dź a > d e
sz a > x e
rz a > r e
ż a > g e
