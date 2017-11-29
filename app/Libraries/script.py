from osgeo import gdal
import sys

input = 'NPP_21616_151230010535.tif'
#output =

ds = gdal.Open(input)
if ds is None:
	print 'Unable to open INPUT.tif'
	sys.exit(1)

#num = ds.RasterCount
#print 'Number of bands:', num

#if num > 1:
#	print 'Leave one band'
#	ds = gdal.Translate('output.tif', ds, bandList = [1])
#	input = 'output.tif'

#print input
#ds = gdal.Open('output.tif')
#srcband = ds.GetRasterBand(1)
#print srcband
#(min,max) = srcband.ComputeRasterMinMax()
#print 'MIN', min, 'MAX', max

#if min == 0:
print '0'
dstDS = gdal.Warp('outputWARP.tif', ds, dstAlpha=True, srcNodata=0)
#else:
#	print '255'
#	dstDS = gdal.Warp('outputWARP.tif', ds, dstAlpha=True, srcNodata=255)

