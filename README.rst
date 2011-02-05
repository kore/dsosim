=======================
Fight simulator for DSO
=======================

This is a fight simulator and unit set optimizer for `"Die Siedler Online"`__.
It simulates the fights according to the published rules and displays the
expected losses.

__ http://www.diesiedleronline.de/

To simulate a simple fight use the ``fight`` command line tool::

    $ ./fight 40R20B 30SL
    Rekrut                        :  14 ( 40) (- 26)
    Bogenschütze                  :  20 ( 20) (-  0)

    versus:

    Schläger                      :   0 ( 30) (- 30)

Additionally this software allows you to select the optimal army from a set of
units you have available. The ``optimize`` command can be used for that::

    $ ./optimize 134R42M111B23LB64C 150WL50WH
    Evaluating 43 different armies:

    Best results:

    141 losses:
    Reiterei                      :   0 ( 24) (- 24)
    Rekrut                        :  17 (134) (-117)
    Miliz                         :  42 ( 42) (-  0)
    Bogenschütze                  :   0 (  0) (-  0)
    Langbogenschütze              :   0 (  0) (-  0)

    144 losses:
    Reiterei                      :  14 ( 64) (- 50)
    Rekrut                        :  40 (134) (- 94)
    Miliz                         :   0 (  0) (-  0)
    Bogenschütze                  :   0 (  0) (-  0)
    Langbogenschütze              :   0 (  0) (-  0)

    145 losses:
    Reiterei                      :   0 (  0) (-  0)
    Rekrut                        :   0 (134) (-134)
    Miliz                         :  31 ( 42) (- 11)
    Bogenschütze                  :   0 (  0) (-  0)
    Langbogenschütze              :   0 (  0) (-  0)

    146 losses:
    Reiterei                      :  14 ( 64) (- 50)
    Rekrut                        :  38 (134) (- 96)
    Miliz                         :   0 (  0) (-  0)
    Bogenschütze                  :   0 (  0) (-  0)
    Langbogenschütze              :   2 (  2) (-  0)

Abbreviations
=============

The abbreviations for the units are the common ones, as documented here:
http://www.siedlertools.de/wiki/Kampfsystem

Prerequisites
=============

You need PHP 5.3 available in your path to run this software.


..
   Local Variables:
   mode: rst
   fill-column: 79
   End: 
   vim: et syn=rst tw=79
