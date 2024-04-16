import argparse
import paramiko

def run_command_via_ssh(host, port, username, password, command):
    ssh = paramiko.SSHClient()
    ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    ssh.connect(host, port, username, password)
    stdin, stdout, stderr = ssh.exec_command(command)
    return stdout.read() + stderr.read()

if __name__ == "__main__":
    # External server
    host = '#'  # IP of external server
    port = ##  # SSH-Port
    username = '#'  # SSH-Userrname
    password = '#'  # SSH-Password

    # Set up the argument parser
    parser = argparse.ArgumentParser(description="Run a script with given userid and email")
    parser.add_argument("--userid", required=True, help="The user ID to pass to the script")
    parser.add_argument("--email", required=True, help="The email to pass to the script")

    # Parse the arguments
    args = parser.parse_args()

    # Build the command
    command1 = f"python3 #.py {args.userid} {args.email}"

    # Run the command
    output1 = run_command_via_ssh(host, port, username, password, command1)

    # Print the output
    print(output1)