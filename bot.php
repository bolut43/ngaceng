date_default_timezone_set ( ' Asia / Jakarta ' );
require_once ( " sdata-modules.php " );
/ **
 * @Author: Eka Syahwan
 * @Tanggal: 2017-12-11 17:01:26
 * @Terakhir Diubah oleh: Eka Syahwan
 * @Terakhir Diubah waktu: 2018-08-17 15:13:34
* /
# ############################################## ############################################### ###########
$ config [ ' deviceCode ' ] 		 =  ' 3551230xxxxxxx ' ;
$ config [ ' tk ' ] 				 =  ' ACGmNhoexxxxxx ' ;
$ config [ ' token ' ] 			 =  ' 35a7oDTxxxxxxx ' ;
$ config [ ' uuid ' ] 			 =  ' abdacad4xxxxxx4 ' ;
$ config [ ' sign ' ] 			 =  ' 12988158bxxxxxx ' ;
$ config [ ' android_id ' ] 		 =  ' a28a65fbbxxxxxx ' ;
# ############################################## ############################################### ###########
untuk ( $ x = 0 ; $ x  < 1 ; $ x ++ ) {
	$ url  	=  array ();
	untuk ( $ cid = 0 ; $ cid  < 20 ; $ cid ++ ) {
		untuk ( $ halaman = 0 ; $ halaman  < 10 ; $ halaman ++ ) {
			$ url [] =  array (
				' url ' 	 =>  ' http://api.beritaqu.net/content/getList?cid= ' . $ cid . ' & halaman = ' . $ halaman ,
				' note ' 	 =>  ' opsional ' ,
			);
		}
		$ ambilBerita  =  $ sdata -> sdata ( $ url ); tidak disetel ( $ url ); tidak disetel ( $ tajuk );
		foreach ( $ ambilBerita  as  $ key  =>  $ value ) {
			$ jdata  =  json_decode ( $ value [ respons ], true );
			foreach ( $ jdata [ data ] [ data ] sebagai  $ key  =>  $ dataArtikel ) {
				$ artikel [] =  $ dataArtikel [ id ];
			}
		}
		$ artikel  =  array_unique ( $ artikel );
		echo  " [+] representasi data artikel (CID: " . $ cid . " ) ==> " . count ( array_unique ( $ artikel )) . " \ r \ n " ;
	}
	while ( TRUE ) {
		$ timeIn30Minutes  =  time () +  30 * 60 ;
		$ rnd  	=  array_rand ( $ artikel );
		$ id  	=  $ artikel [ $ rnd ];
		$ url [] =  array (
			' url ' 	 =>  ' http://api.beritaqu.net/timing/read ' ,
			' note ' 	 =>  $ rnd ,
		);
		$ header [] =  array (
			' post '  =>  ' OSVersion = 8.0.0 & android_channel = google & android_id = ' . $ config [ ' android_id ' ] . ' & content_id = ' . $ id . ' & content_type = 1 & deviceCode = ' . $ config [ ' deviceCode ' ] . ' & device_brand = samsung & device_ip = 114.124.239. ' . rand ( 0 , 255 ) . '& device_version = SM-A730F & dtu = 001 & lat = & lon = & jaringan = wifi & pack_channel = google & time = ' . $ waktuIn30 Menit . ' & tk = ' . $ config [ ' tk ' ] . ' & token = ' . $ config [ ' token ' ] . ' & uuid = ' . $ config [ ' uuid ' ] . ' & versi = 10047 & versionName = 1.4.7 & tanda = ' .
		);
		$ respons  =  $ sdata -> sdata ( $ url , $ header );
		tidak disetel ( $ url ); tidak disetel ( $ tajuk );
		foreach ( $ respons  as  $ key  =>  $ value ) {
			$ rjson  =  json_decode ( $ value [ respons ], true );
			gema  " [+] [ " . $ id . " (Langsung: " . Count ( $ artikel ) . " )] Pesan: " . $ rjson [ ' message ' ] . " | Poin: " . $ rjson [ ' data ' ] [ ' jumlah ' ] . " | Baca Kedua: " . $ rjson [ ' data ' ] [ 'current_read_second ' ] . " \ r \ n " ;
			if ( $ rjson [ code ] ==  ' -20003 '  ||  $ rjson [ ' data ' ] [ ' current_read_second ' ] ==  ' 330 '  ||  $ rjson [ ' data ' ] [ ' jumlah ' ] ==  0 ) {
				tidak disetel ( $ artikel [ $ value [ data ] [ note ]]);
			}
		}
		if ( count ( $ artikel ) ==  0 ) {
			tidur ( 30 );
			istirahat ;
		}
		tidur ( 5 );
	}
	$ x ++ ;
}
