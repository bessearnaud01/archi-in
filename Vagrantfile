# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "Ubuntu_Server_20_04"
  config.ssh.private_key_path = "vagrant2"
  config.vm.synced_folder ".", "/vagrant", :owner => "www-data", :group => "www-data"
  config.vm.network :forwarded_port, guest: 80, host: 8181

  config.ssh.shell = "bash -c 'BASH_ENV=/etc/profile exec bash'"
  config.vm.provision "shell", path: "vagrant-bootstrap.sh"
end
