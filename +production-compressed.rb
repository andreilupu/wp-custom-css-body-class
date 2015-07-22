#!/usr/bin/env ruby

# change to script
Dir.chdir File.expand_path(File.dirname(__FILE__))
# run compass compiler
Kernel.exec('sass --compass --style compressed --force --update scss:css -E utf-8')
