tell application "Finder"
	try
		set pathList to (quoted form of POSIX path of (folder of the front window as alias))
		log pathList
	end try
end tell