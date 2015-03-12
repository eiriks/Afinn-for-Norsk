#!/usr/bin/python
# encoding: utf-8
#
# wget wget http://www2.imm.dtu.dk/pubdb/views/edoc_download.php/6010/zip/imm6010.zip
# unzip imm6010.zip


# ==========================================================================
# = I dette dokumentet leker jeg med afinn-ordlisten til Finn Årup Nielsen
# = målet var kort og enkelt: fungerer dette på norsk?
# = det jeg har gjort er lynraskt å la google oversette Finns liste til Norsk
# = (som kjent fungerer det sånn halvveis, men det er i alle fall et sted å starte, og det gikk fort)
# =
# = jeg har ikke testet dette på annet en små tekststrenger, og aner egentig ikke om det virker.
# = det er dødelig enkelt, og har MASSE svakheter, men, med de stor talls lov og en mer utførlig og presis ordliste..
# = så kan dette funke til noen formål ?
# =
# = Eirik Stavelin, april 2012
# ==========================================================================

import math
import re
import sys
reload(sys)
sys.setdefaultencoding('utf-8')

import codecs
import nltk

#f = codecs.open('AFINN/norsk.txt', 'r', 'utf-8-sig')
finn = {}
for line in codecs.open('./norsk.txt', 'r', 'utf-8-sig'):
    #print line.split('\t')
    key, val = line.split('\t')
    finn[key] = int(val)

# dette er en endring slik at git   ser det

# AFINN-111 is as of June 2011 the most recent version of AFINN
# filenameAFINN = 'AFINN/norsk.txt'
# afinn = dict(map(lambda (w, s): (w, int(s)), [ws.strip().split('\t') for ws in open(filenameAFINN) ]))
# Word splitter pattern
# pattern_split = re.compile(r"\W+", re.UNICODE)

def sentiment(text):
    """
    Returns a float for sentiment strength based on the input text.
    Positive values are positive valence, negative value are negative valence.
    """
    #words = pattern_split.split(text.lower())

    # tester ulike tokenizers
    #words2 = nltk.word_tokenize(text.decode('utf8')) #decode converterer str til unicode
    # [u'skaml', u'\xf8', u's', u'!', u'r', u'\xf8', u'r.', u's', u'\xf8', u'l', u',', u'denne', u'burde', u'ha', u'v', u'\xe6', u'rt', u'|', u'\\', u'|', u'egat1', u'\\', u'/']
    #words3 = nltk.blankline_tokenize(text.decode('utf8'))
    # [u'skaml\xf8s! r\xf8r. s\xf8l, denne burde ha v\xe6rt |\\|egat1\\/']
    words4 = nltk.wordpunct_tokenize(text.decode('utf8'))
    #[u'skaml\xf8s', u'!', u'r\xf8r', u'.', u's\xf8l', u',', u'denne', u'burde', u'ha', u'v\xe6rt', u'|\\|', u'egat1', u'\\/']

    # print text
    # print words2
    # print "\t"+" ".join(words2)
    # print words3
    # print "\t"+" ".join(words3)
    # print words4
    # print "\t"+" ".join(words4)
    # print "*"*10

    sentiments = map(lambda word: finn.get(word, 0), words4)
    if sentiments:
        #print sentiments
        # How should you weight the individual word sentiments?
        # You could do N, sqrt(N) or 1 for example. Here I use sqrt(N)
        sentiment = float(sum(sentiments))/math.sqrt(len(sentiments))

    else:
        sentiment = 0
    return sentiment

if __name__ == '__main__':
    # Single sentence example:
    # ===============================
    # = Gyri: her er porblemet mitt =
    # ===============================
    # hvordan får jeg rør, søl og skamløs til å bli negative (altså, hvordan sammenlikne ord med øæå i seg?)

    # text = "skamløs rør søl denne burde ha vært |\|egat1\/".encode('utf-8')
    # test2 = 'skaml\xc3\xb8s'
    # test = "skamløs".encode('utf-8')
    # print text
    # print repr(text)
    # print repr(test2)
    # print repr(test)
    #
    # if test == test2:
    #     print "true"
    # else:
    #     print "false"
    # print("%6.2f %s" % (sentiment(text), text))

    text = "skamløs! rør. søl, denne burde ha vært negativ"
    print("%6.2f %s" % (sentiment(text), text))

    text = "Finn er dum, feit, lat. og skamløs"
    print("%6.2f %s" % (sentiment(text), text))

    text = "søt hyggelig snill glad happy sex"
    print("%6.2f %s" % (sentiment(text), text))
    #
    # text = "verden går til helvete, herfra går det bare ned"
    # print("%6.2f %s" % (sentiment(text), text))
    #
    # text = "det skader ikke å gå planken, men det kan være uheldig."
    # print("%6.2f %s" % (sentiment(text), text))

    # text = "statan i helvete dette er det kipeste jeg kan faenmag tenke på"
    # print("%6.2f %s" % (sentiment(text), text))
    #
    # text = "dette er fantastisk, jeg gleder meg over framgangen vi oppnår her"
    # print("%6.2f %s" % (sentiment(text), text))
    #
    # text = "Eirik er dritkul"
    # print("%6.2f %s" % (sentiment(text), text))
    #
    # text = "Eirik er dritkul :("
    # print("%6.2f %s" % (sentiment(text), text))
    #
    # text = "@Trinesg var streng med rette i dag. Bra! #aktuelt"
    # print("%6.2f %s" % (sentiment(text), text))
    #
    # text = "@eidem Nei. At det er frivillig, og kan kreves slettet til enhver tid, hjelper. Men målet bør være null lagring, jf målet i EU-rett før #dld"
    # print("%6.2f %s" % (sentiment(text), text))
    #

    # text = """Dokumentasjonen NRK fremlegger bekrefter så vidt vi kan se at dette produktet holder seg innenfor myndighetenes grenseverdier, noe som er i samsvar med dokumentasjonen vi har på dette produktet. Vi vil fase ut dette produktet og erstatte det med et PFOA-fritt alternativ av like høy kvalitet."""
    # print("%6.2f %s" % (sentiment(text), text))
    #
    # text = """Det er morsomt at de snille "humanister" nu reagerer på overvåkningstjenestenhs aktiviteter. "Humanistene" glemmer at vi har en aktiv og effektiv mafia i arbeid. Eksempelvis dreper latviske bander for stykkpris kr 80.000,-, og de slår da i hjel offeret med balltre. Mafiaen vil gjerne eksponere og bekjempe PST, og får god hjelp av snillister og spesielle advokater. Kanskje "snllistene" skal stikke fingeren i jorden og erkjenne hvordan samfunnet har blitt etter en ukontrollert import fra syd-øst? Det er f.eks. dessverre et faktum at mye kriminalitet organsieres via det "humane tiggermiljø". De nyttige idioter vil alltid bistå de destruktive krefter!"""
    # print("%6.2f %s" % (sentiment(text), text))
    #

    # text = """
    # Klima- og forureiningsdirektoratet rår Miljøverndepartementet til å utsetja avgjera om fjordeponi  i Førdefjorden i eit år.
    # Betre utgreiing først
    # sprenginga og den støyforureininga den vil føra til, bør utgreiast betre før avgjerda vert fatta, meiner Klima- og forureiningsdirektoratet.
    # Dette kom fram på ein pressekonferanse i dag tidleg i Oslo. Det var direktør Ellen Hambro i Klima- og forureiningsdirektoratet som la fram tilrådinga.
    # Her kan du lesa heile tilråinga fra Klima- og forurensingsdirektoratet.
    # Direktoratet for naturforvaltning, tilrår og Miljøverndepartementet til å utsetja avgjerda om fjorddeponi i eit år. Dei legg særleg vekt på at det må forskast meir på verknaden av fjorddeponi, før endeleg avgjerd vert fatta.
    # Omstridt
    # Gruveplanane i bygda Vevring er sterkt omstridde fordi selskapet Nordic Mining vil deponere store mengder overskotsmasse i Førdefjorden.
    # Dei har søkt om gruvedrift i fjellet for å utvinna det verdifulle mineralet rutil i Naustdal kommune.
    # For å utvinna mineralet må gruveselskapet blant anna tømma mange hundre tonn med steinmasse i Førdefjorden i 50 år framover.
    # Kommunen sa i mai i fjor ja til utvinninga.
    # - Det var eit klart fleirtall og med dette vedtaket har vi lagt til rette for 170 nye arbeidsplassar i kommunen, sa ordfører Håkon Myrvang (Ap) til bt.no i fjor.
    # """
    # print("%6.2f %s" % (sentiment(text), text))


    # No negation and booster words handled in this approach
    # text = "Finn is only a tiny bit stupid and not idiotic"
    # print("%6.2f %s" % (sentiment(text), text))


    # Example with downloading from Twitter:
    # import simplejson
    # import urllib
    #
    # query = "pfizer"
    # json = simplejson.load(urllib.urlopen("http://search.twitter.com/search.json?q=" + query))
    # sentiments = map(sentiment, [ tweet['text'] for tweet in json['results'] ])
    # print("%6.2f %s" % (sum(sentiments)/math.sqrt(len(sentiments)), query))
