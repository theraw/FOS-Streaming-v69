#!/bin/bash

installLibs(){
echo "Installing prerequisites"
sudo apt-get update
sudo apt-get -y --force-yes install autoconf automake build-essential libass-dev libfreetype6-dev libgpac-dev \
  libsdl1.2-dev libtheora-dev libtool libva-dev libvdpau-dev libvorbis-dev libxcb1-dev libxcb-shm0-dev \
  libxcb-xfixes0-dev pkg-config texi2html zlib1g-dev libfaac-dev
}

#Compile yasm
compileYasm(){
echo "Compiling yasm"
cd ~/ffmpeg_sources
wget http://www.tortall.net/projects/yasm/releases/yasm-1.3.0.tar.gz
tar xzvf yasm-1.3.0.tar.gz
cd yasm-1.3.0
./configure --prefix="$HOME/ffmpeg_build" --bindir="$HOME/bin"
make
make install
make distclean
}

#Compile libx264
compileLibX264(){
echo "Compiling libx264"
cd ~/ffmpeg_sources
wget http://download.videolan.org/pub/x264/snapshots/last_x264.tar.bz2
tar xjvf last_x264.tar.bz2
cd x264-snapshot*
PATH="$HOME/bin:$PATH" ./configure --prefix="$HOME/ffmpeg_build" --bindir="$HOME/bin" --enable-static
PATH="$HOME/bin:$PATH"
make
make install
make distclean
}

#Compile libx265
compileLibX265(){
echo "Compiling libx265"
cd ~/ffmpeg_sources
wget https://github.com/videolan/x265/archive/master.zip
unzip master.zip
cd x265-master
PATH="$HOME/bin:$PATH" ./configure --prefix="$HOME/ffmpeg_build" --bindir="$HOME/bin" --enable-static
PATH="$HOME/bin:$PATH" 
cmake .
make install
make distclean
}


#Compile libfdk-acc
compileLibfdkcc(){
echo "Compiling libfdk-cc"
sudo apt-get install unzip
cd ~/ffmpeg_sources
wget -O fdk-aac.zip https://github.com/mstorsjo/fdk-aac/zipball/master
unzip fdk-aac.zip
cd mstorsjo-fdk-aac*
autoreconf -fiv
./configure --prefix="$HOME/ffmpeg_build" --disable-shared
make
make install
make distclean
}

#Compile libmp3lame
compileLibMP3Lame(){
echo "Compiling libmp3lame"
sudo apt-get install nasm
cd ~/ffmpeg_sources
wget http://downloads.sourceforge.net/project/lame/lame/3.99/lame-3.99.5.tar.gz
tar xzvf lame-3.99.5.tar.gz
cd lame-3.99.5
./configure --prefix="$HOME/ffmpeg_build" --enable-nasm --disable-shared
make
make install
make distclean
}

#Compile libopus
compileLibOpus(){
echo "Compiling libopus"
cd ~/ffmpeg_sources
wget http://downloads.xiph.org/releases/opus/opus-1.1.tar.gz
tar xzvf opus-1.1.tar.gz
cd opus-1.1
./configure --prefix="$HOME/ffmpeg_build" --disable-shared
make
make install
make distclean
}

#Compile libvpx
compileLibPvx(){
echo "Compiling libvpx"
cd ~/ffmpeg_sources
wget http://webm.googlecode.com/files/libvpx-v1.3.0.tar.bz2
tar xjvf libvpx-v1.3.0.tar.bz2
cd libvpx-v1.3.0
PATH="$HOME/bin:$PATH" ./configure --prefix="$HOME/ffmpeg_build" --disable-examples
PATH="$HOME/bin:$PATH" make
make install
make clean
}

## Compile Bzip
compileLibBzip(){
echo "Compiling Bzip"
cd ~/ffmpeg_sources
wget "http://198.20.126.212/bzip2-1.0.6.tar.gz"
tar zxvf bzip2-1.0.6.tar.gz
cd bzip2-1.0.6
make 
sudo make install PREFIX=$HOME
}

## Compile libpng
compileLibPng(){
echo "Compiling libpng"
cd ~/ffmpeg_sources
wget "http://198.20.126.212/libpng-1.6.17.tar.gz"
tar zxvf libpng-1.6.17.tar.gz
cd libpng-1.6.17
CFLAGS="-I$HOME/ffmpeg_build/include" LDFLAGS="-L$HOME/ffmpeg_build/lib -lm" ./configure --prefix="$HOME" --enable-static --disable-shared
make 
sudo make install
}

## Compile libogg
compileLibOgg(){
echo "Compiling libogg"
cd ~/ffmpeg_sources
wget "http://198.20.126.212/libogg-1.3.2.tar.gz"
tar zxvf libogg-1.3.2.tar.gz
cd libogg-1.3.2
CFLAGS="-I$HOME/ffmpeg_build/include" LDFLAGS="-L$HOME/ffmpeg_build/lib -lm" ./configure --prefix="$HOME" --enable-static --disable-shared
make 
sudo make install
}

#Compile ffmpeg
compileFfmpeg(){
echo "Compiling ffmpeg"
cd ~/ffmpeg_sources
wget http://ffmpeg.org/releases/ffmpeg-snapshot.tar.bz2
tar xjvf ffmpeg-snapshot.tar.bz2
cd ffmpeg
PATH="$HOME/bin:$PATH" PKG_CONFIG_PATH="$HOME/ffmpeg_build/lib/pkgconfig" ./configure \
  --prefix="$HOME/ffmpeg_build" \
  --extra-cflags="-I$HOME/ffmpeg_build/include" \
  --extra-ldflags="-L$HOME/ffmpeg_build/lib" \
  --bindir="$HOME/bin" \
  --disable-debug \
--disable-shared \
--enable-static \
--disable-ffplay \
--disable-ffserver \
--disable-doc \
--enable-gpl \
--enable-pthreads \
--enable-postproc \
--enable-gray \
--enable-runtime-cpudetect \
--enable-libfaac \
--enable-libfdk-aac \
--enable-libmp3lame \
--enable-libtheora \
--enable-libvorbis \
--enable-libx264 \
--enable-bzlib \
--enable-zlib \
--enable-nonfree \
--enable-version3 \
--enable-libvpx \
--disable-devices \
--enable-decoder=png \
--enable-encoder=png 
PATH="$HOME/bin:$PATH" 
make
make install
make distclean
hash -r
}

#The process
cd ~
mkdir ffmpeg_sources
installLibs
compileYasm
compileLibX264
compileLibX265
compileLibfdkcc
compileLibMP3Lame
compileLibOpus
compileLibPvx
compileLibBzip
compileLibPng
compileLibOgg
compileFfmpeg

cp ~/bin/ffmpeg /usr/bin/
cp ~/bin/ffprobe /usr/bin/
