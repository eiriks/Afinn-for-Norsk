Afinn-for-Norsk
===============
I dette dokumentet leker jeg med afinn-ordlisten til Finn Årup Nielsen*
 målet var kort og enkelt: fungerer dette på norsk?
 det jeg har gjort er lynraskt å la google oversette Finns liste til Norsk
 (som kjent fungerer det sånn halvveis, men det er i alle fall et sted å starte, og det gikk fort)

 jeg har ikke testet dette på annet en små tekststrenger, og aner egentig ikke om det virker.
det er dødelig enkelt, og har MASSE svakheter, men, med de stor talls lov og en mer utførlig og presis ordliste..
så kan dette funke til noen formål ?

Eirik Stavelin, april 2012


'* se
- [Finn Årup Nielsens paper](http://www2.imm.dtu.dk/pubdb/views/publication_details.php?id=6010)
- http://fnielsen.posterous.com/afinn-a-new-word-list-for-sentiment-analysis
- http://fnielsen.posterous.com/tag/afinn


## todo
- må la brukere legge til egne ord
- tell, og gi bruker feedback på framgang (Gamification?)

## GUI
AFINN listen min er automatisk oversatt av google, noe som ikke er optimalt.
For å la mennesker manuelt gå gjennom liten finnes er GUI på http://stavelin.com/sentiment/

.. og denne listen finnes tydligvis fra før, i en eller annen skuff, i følge: http://acl2014.org/acl2014/W14-26/pdf/W14-2616.pdf og i http://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&arnumber=7023584 finner jeg at de er her: https://github.com/aleksab/lexicon

# Under finner du readme fra versjon av orginalprosjektet jeg fant ordlisten på:
AFINN is a list of English words rated for valence with an integer
between minus five (negative) and plus five (positive). The words have
been manually labeled by Finn Årup Nielsen in 2009-2011. The file
is tab-separated. There are two versions:

AFINN-111: Newest version with 2477 words and phrases.

AFINN-96: 1468 unique words and phrases on 1480 lines. Note that there
are 1480 lines, as some words are listed twice. The word list in not
entirely in alphabetic ordering.  

An evaluation of the word list is available in:

Finn Årup Nielsen, "A new ANEW: Evaluation of a word list for
sentiment analysis in microblogs", http://arxiv.org/abs/1103.2903

The list was used in:

Lars Kai Hansen, Adam Arvidsson, Finn Årup Nielsen, Elanor Colleoni,
Michael Etter, "Good Friends, Bad News - Affect and Virality in
Twitter", The 2011 International Workshop on Social Computing,
Network, and Services (SocialComNet 2011).


This database of words is copyright protected and distributed under
"Open Database License (ODbL) v1.0"
http://www.opendatacommons.org/licenses/odbl/1.0/ or a similar
copyleft license.

See comments on the word list here:
http://fnielsen.posterous.com/old-anew-a-sentiment-about-sentiment-analysis


In Python the file may be read into a dictionary with:

>>> afinn = dict(map(lambda (k,v): (k,int(v)),
                     [ line.split('\t') for line in open("AFINN-111.txt") ]))
>>> afinn["Good".lower()]
3
>>> sum(map(lambda word: afinn.get(word, 0), "Rainy day but still in a good mood".lower().split()))
2
