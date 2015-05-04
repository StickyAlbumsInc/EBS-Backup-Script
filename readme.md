EBS Backup Script
===

Automatically back up tagged EBS volumes.


###Tag EBS Volumes

Log in to your AWS Management Console and go to your list of EBS volumes ("EC2" > "Volumes"). From this list, select the volumes you want to back up. 

In the properties panel, click "Tags", then "Add/Edit Tags". Click the "Create Tag" button and add a new tag to signify that this volume should be backed up automatically. Let's call it "BackupDaily." Just set the value to "true" for now. At we really care about is that the tag exists.

Don't forget to save when you're done.

###install AWS CLI

If you haven't done so, install the AWS Command Line tools on one of your EC2 instances. 

    cd ~
    wget https://s3.amazonaws.com/aws-cli/awscli-bundle.zip
    unzip awscli-bundle.zip
    sudo ./awscli-bundle/install -i /usr/local/aws -b /usr/local/bin/aws

Then configure the tools - You'll need to have an IAM user for this. If you haven't done that already, you can read all about it [here](http://docs.aws.amazon.com/IAM/latest/UserGuide/IAM_Introduction.html)

There are a lot of ways to configure the tools, but perhaps the easiest is just to run `aws configure` and fill out the fields when prompted. For the default region, you should select the region where your EBS volumes reside. For the output format, you can just use "text" for now.

###Install the Script

Now copy `backup.php` script to your EC2 instance. It can live anywhere on you'd like on your server. For now, let's just assume you put it in your home directory.

###Usage

You can now manually run this whenever you like (`php backup.php`), or you can create a cron job using `crontab -e` to automatically run the backups.

Like so:

    0 0 * * * /usr/bin/php -q ~/backup.php >> /dev/null 2>&1
    
In this example, Cron will run the EBS backup script every night at midnight.
