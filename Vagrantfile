# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.require_version ">= 2.1"

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  required_plugins = %w(vagrant-vbguest vagrant-hostmanager)

  # Install plugins if missing
  plugins_to_install = required_plugins.select {|plugin| not Vagrant.has_plugin? plugin}
  if plugins_to_install.any?
    puts "Installing plugins: #{plugins_to_install.join(' ')}"
    if system "vagrant plugin install #{plugins_to_install.join(' ')}"
      exec "vagrant #{ARGV.join(' ')}"
    else
      abort "Installation of one or more plugins has failed. Aborting."
    end
  end

  # Set auto_update to false, if you do NOT want to check the correct additions version when booting VM's
  if Vagrant.has_plugin?("vagrant-vbguest")
    config.vbguest.auto_update = false
  end

  # # Configure hosts
  # if Vagrant.has_plugin?("vagrant-hostmanager")
  #   config.hostmanager.enabled = true
  #   config.hostmanager.manage_host = true
  #   config.hostmanager.manage_guest = true
  #   config.hostmanager.ignore_private_ip = false
  #
  #   # Configuration attribute can be used to provide aliases for your host names.
  #   config.hostmanager.aliases = %w(dev.local example-box.localdomain example-box-alias)
  # end

  config.vm.define "advent-of-code-solutions", primary: true do |adventofcode_config|
    adventofcode_config.vm.box = "ubuntu/xenial64"
    adventofcode_config.vm.box_check_update = true
    adventofcode_config.vm.network "private_network", ip: "192.168.10.10"
    adventofcode_config.vm.provider "virtualbox" do |vb|
      vb.name = "advent-of-code-solutions-VM"
      vb.cpus = 2
      vb.memory = 4096
    end

    adventofcode_config.vm.hostname = "advent-of-code-solutions"

    adventofcode_config.ssh.insert_key = false

    adventofcode_config.vm.synced_folder ".", "/vagrant", disabled: true
    adventofcode_config.vm.synced_folder ".", "/var/advent-of-code-solutions", create: true

    adventofcode_config.vm.provision "docker"
  end
end
